<?php

namespace App\Http\Controllers;

use App\OrdenProduccion;
use App\OrdenProduccionDetalle;
use App\OrdenProduccionDetalleNoTrazable;
use App\OrdenProduccionDetalleTrazable;
use App\PrestamoCliente;
use App\Utils\PrestamosManager;
use App\Utils\StockManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdenProduccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ops = DB::table('orden_de_produccion')
            ->join('alimento','orden_de_produccion.producto_id','=','alimento.id')
            ->join('empresa','alimento.cliente_id','=','empresa.id')
            ->select('orden_de_produccion.id as op_id','empresa.denominacion as empresa',
                'orden_de_produccion.fecha_fabricacion','alimento.descripcion',
                'orden_de_produccion.cantidad')
            ->get();

        return view('administracion.pedidos.index', compact('ops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $clientes = DB::table('cliente')
            ->join('empresa','cliente.id','=','empresa.id')
            ->select('cliente.id','empresa.denominacion')->get();
        return view('administracion.pedidos.altaPedidosNew',compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'cliente' => ['required', 'exists:cliente,id'],
            'producto' => ['required', 'exists:alimento,id'],
            'cantidad' => ['required', 'numeric', 'integer', 'min:0'],
            'fechaentrega' => ['required', 'date'],
            'precioxkg' => ['required', 'numeric']
        ]);

        $insumosTrazables = $request->insumos_trazables;
        $insumosNoTrazables = $request->insumos_no_trazables;

        $idClienteOrden = $validated['cliente'];
        $idProducto = $validated['producto'];
        $cantidadFabricar = $validated['cantidad'];
        $fechaEntrega = $validated['fechaentrega'];
        $precioXkg = $validated['precioxkg'];


        $id_formula = DB::table('alimento_formula')
            ->where('alimento_id', '=', $idProducto)
            ->where('fecha_hasta', '=', null)
            ->select('alimento_formula.id')
            ->get()
            ->first();

        $formula = DB::table('formula_composicion as f')
            ->where('f.formula_id','=',$id_formula->id)
            ->join('insumo', 'f.insumo_id', 'insumo.id')
            ->select('f.insumo_id', 'insumo.descripcion', 'f.kilos_por_tonelada')
            ->get();

        $insumosReferencia = [];

        foreach ($formula as $key=>$value) {
            $id_insumo = $value->insumo_id;
            $kilos_por_tonelada = $value->kilos_por_tonelada;
            $insumosReferencia[$id_insumo] = $kilos_por_tonelada;
        }

        foreach ($insumosTrazables as $value){
            $idInsumoRecibido = $value['id_insumo_fila_insumos'];
            $stockAUtilizar = $value['stock_utilizar'];
            $loteAUtilizar = $value['lote_insumo'];
            $nombreInsumo = DB::table('insumo')->find($idInsumoRecibido)->descripcion;

            if ($this->cumpleProporcion($idInsumoRecibido, $stockAUtilizar, $cantidadFabricar, $insumosReferencia)){
                if (!$this->alcanzaStockTrazable($idClienteOrden, $idInsumoRecibido, $loteAUtilizar, $stockAUtilizar)) {
                    return back()->with('error', "Cantidad de lote $loteAUtilizar de $nombreInsumo insuficiente");
                }
            }
            else {
                return back()->with('error', "La cantidad $stockAUtilizar kg de $nombreInsumo no respeta la fórmula");
            }
        }

        foreach ($insumosNoTrazables as $value){
            $idInsumoRecibido = $value['id_insumo_fila_insumos'];
            $stockAUtilizar = $value['stock_utilizar'];
            $stockAUtilizarFabrica = $value['stock_utilizar_Fabrica'];
            $nombreInsumo = DB::table('insumo')->find($idInsumoRecibido)->descripcion;
            if (key_exists($idInsumoRecibido, $insumosReferencia)) {
                if ($this->cumpleProporcion($idInsumoRecibido, $stockAUtilizar, $cantidadFabricar, $insumosReferencia)) {
                    // Solo chequea el stock de
                    if (!$this->alcanzaStockNoTrazableCliente($idClienteOrden, $idInsumoRecibido, $stockAUtilizar)) {
                        return back()->with('error', "Cantidad INSUFICIENTE de $nombreInsumo del cliente.");
                    } else {
                        if (!$this->alcanzaStockFabrica($idInsumoRecibido, $stockAUtilizarFabrica)) {
                            return back()->with('error', "Cantidad INSUFICIENTE de $nombreInsumo de la fábrica.");
                        }
                        else {
                            if (!$this->tieneCreditoCliente($idClienteOrden, $stockAUtilizarFabrica)){
                                return back()->with('error', "El cliente no tiene crédito suficiente para $nombreInsumo.");
                            }
                        }
                    }
                } else {
                    return back()->with('error', "Cantidad de $nombreInsumo no respeta la fórmula.");
                }
            }
            else {
                return back()->with('error', "Insumo $nombreInsumo no pertenece a la fórmula.");
            }
        }

        // Si son correctos los insumos recibidos
        $orden = new OrdenProduccion();
        $orden->producto_id = $idProducto;
        $orden->cantidad = $cantidadFabricar;
        $orden->saldo = $cantidadFabricar;

        $orden->fecha_fabricacion = $fechaEntrega;
        $orden->precio_venta_por_kilo = $precioXkg;
        $orden->save();

        /* Voy creando detalles de la op por cada insumo trazable recibido */
        foreach ($insumosTrazables as $insumo){
            $opdetalle = new OrdenProduccionDetalle();
            $opdetalle->cantidad = $insumo['stock_utilizar'];
            $opdetalle->op_id = $orden->id;
            $opdetalle->save();
            $opDetalleTrazable = new OrdenProduccionDetalleTrazable();
            $opDetalleTrazable->op_detalle_id = $opdetalle->id;
            if (isset($insumo['lote_insumo'])) {
                $loteInsumo = DB::table('lote_insumo_especifico as lie')
                    ->where('lie.nro_lote', '=', $insumo['lote_insumo'])
                    ->join('insumo_especifico as ie', 'ie.gtin', 'lie.insumo_especifico')
                    ->where('ie.insumo_trazable_id', '=', $insumo['id_insumo_fila_insumos'])
                    ->select('lie.id')
                    ->get()->first();

                $opDetalleTrazable->lote_insumo_id = $loteInsumo->id;
                $opDetalleTrazable->save();
            }
            else {
                // Si no existe lote
                return back()->with('error', 'Insumo insuficiente para registrar el pedido');
            }
        }

        /* Voy creando detalles de la op por cada insumo no trazable recibido */
        foreach ($insumosNoTrazables as $insumo){

            $idInsumo = $insumo['id_insumo_fila_insumos'];
            $cantidadUsarCliente = $insumo['stock_utilizar'];
            $cantidadUsarFabrica = $insumo['stock_utilizar_Fabrica'];

            if ($cantidadUsarCliente > 0) {

                $opdetalle = new OrdenProduccionDetalle();
                $opdetalle->cantidad = $cantidadUsarCliente;
                $opdetalle->op_id = $orden->id;
                $opdetalle->save();

                $opDetalleNoTrazable = new OrdenProduccionDetalleNoTrazable();
                $opDetalleNoTrazable->op_detalle_id = $opdetalle->id;
                $opDetalleNoTrazable->insumo_id = $idInsumo;
                $opDetalleNoTrazable->cliente_id = $idClienteOrden; // La cantidad es del cliente de la orden
                $opDetalleNoTrazable->save();
            }

            // Si piden usar insumos de la fabrica
            if ($cantidadUsarFabrica > 0) {
                $opdetalle = new OrdenProduccionDetalle();
                $opdetalle->cantidad = $cantidadUsarFabrica;
                $opdetalle->op_id = $orden->id;
                $opdetalle->save();

                $opDetalleNoTrazable = new OrdenProduccionDetalleNoTrazable();
                $opDetalleNoTrazable->op_detalle_id = $opdetalle->id;
                $opDetalleNoTrazable->insumo_id = $idInsumo;
                $opDetalleNoTrazable->cliente_id = 1;
                $opDetalleNoTrazable->save();

                $prestamo = new PrestamoCliente();
                $prestamo->op_detalle_id = $opdetalle->id;
                $prestamo->save();
            }
        }

        return redirect()->action('OrdenProduccionController@index')
            ->with('message','Pedido registrado con éxito!');

    }

    public function cumpleProporcion($idInsumoRecibido, $stockAUtilizar, $cantidadFabricar, $insumosReferencia){
        $proporcionEsperada = $insumosReferencia[$idInsumoRecibido];
        if ($proporcionEsperada != ($stockAUtilizar / $cantidadFabricar * 1000)) {
            return false;
        }
        return true;
    }

    private function alcanzaStockTrazable($idClienteOrden, $idInsumoRecibido, $loteAUtilizar, $stockAUtilizar)
    {
        $stock = StockManager::getStockLoteCliente($idClienteOrden, $loteAUtilizar);
        return $stock >= $stockAUtilizar;
    }

    private function alcanzaStockNoTrazableCliente($idClienteOrden, $idInsumoRecibido, $stockAUtilizar)
    {
        $stock = StockManager::getStockInsumoNoTrazableCliente($idInsumoRecibido, $idClienteOrden);
        return $stock >= $stockAUtilizar;
    }

    private function alcanzaStockFabrica($idInsumoRecibido, $stockAUtilizarFabrica)
    {
        $stockFabrica = StockManager::getStockInsumoFabrica($idInsumoRecibido);
        return $stockFabrica >= $stockAUtilizarFabrica;
    }

    private function tieneCreditoCliente($idClienteOrden, $stockAUtilizarFabrica)
    {
        $credito = PrestamosManager::getLimiteRestanteCliente($idClienteOrden);
        return $credito >= $stockAUtilizarFabrica;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function getProductoCliente(Request $request){
       $id_cliente = $request->get('id');

       $productos = DB::table('alimento')
                    ->where('cliente_id','=',$id_cliente)->get();
       return response()->json($productos);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function getformulaProducto(Request $request)
    {
        $id_producto = $request->get('id');
        $cantidad = $request->get('cantidad');

        $id_cliente = DB::table('alimento')->where('id', '=', $id_producto)->get()->first()->cliente_id;

        $id_formula = DB::table('alimento_formula')
            ->where('alimento_id', '=', $id_producto)
            ->where('fecha_hasta', '=', null)
            ->select('alimento_formula.id')
            ->get()
            ->first();

        if (!is_null($id_formula)) {

            $formula = DB::table('formula_composicion as f')
                ->where('f.formula_id', '=', $id_formula->id)
                ->join('insumo', 'f.insumo_id', 'insumo.id')
                ->select('f.insumo_id', 'insumo.descripcion', 'f.kilos_por_tonelada')
                ->get();

            $rta = [];

            foreach ($formula as $key => $value) {

                $id_insumo = $value->insumo_id;

                $is_trazable = DB::table('insumo as i')
                    ->where('i.id', '=', $id_insumo)
                    ->join('insumo_trazable', 'insumo_trazable.id', '=', 'i.id')
                    ->exists();

                $kilos_por_tonelada = $value->kilos_por_tonelada;

                $element = [];
                $element['id_insumo'] = $id_insumo;
                $element['nombre_insumo'] = $value->descripcion;
                $element['cantidad_requerida'] = $kilos_por_tonelada * $cantidad / 1000;

                if ($is_trazable) {
                    $lotes = StockManager::getLotesStockCliente($id_insumo, $id_cliente);
                    $element['lotes'] = $lotes;
                } else {
                    $element['stock_cliente'] = StockManager::getStockInsumoNoTrazableCliente($id_insumo, $id_cliente);
                    $element['stock_fabrica'] = StockManager::getStockInsumoFabrica($id_insumo);
                    $element['limite_cliente'] = PrestamosManager::getLimiteRestanteCliente($id_cliente);
                }

                $rta[] = $element;
            }

            $json = response()->json($rta)->getData();

            return response()->json($rta);
        } else {
            return back()->with('error');  // Chequear que pasa con js
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function getClienteProdForm (Request $request){
        $id_producto = $request->get('id_prod');
        $id_cliente = $request->get('id_cliente');

        /*$formula = DB::table('')
            ->join('movimiento_insumo','movimiento_insumo.cliente_id','=',$id_cliente)
            ->join()
            ->select('cliente.id','empresa.denominacion')->get();*/
        return response()->json();

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function getFabricaProdForm (Request $request){
        $id_producto = $request->get('id_prod');
        $id_cliente = $request->get('id_cliente');

        /*$formula = DB::table('')
            ->join('movimiento_insumo','movimiento_insumo.cliente_id','=',$id_cliente)
            ->join()
            ->select('cliente.id','empresa.denominacion')->get();*/
        return response()->json();
    }




}
