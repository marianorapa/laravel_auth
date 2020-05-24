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
     * @return \Illuminate\Http\Response
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

        $cantidadFabricar = $validated['cantidad'];

        $insumosTrazables = $request->insumos_trazables;
        $insumosNoTrazables = $request->insumos_no_trazables;

        $idProducto = $validated['producto'];

        $id_formula = DB::table('alimento_formula')
            ->where('alimento_id', '=', $idProducto)
            ->where('fecha_hasta', '=', null)
            ->select('alimento_formula.id')
            ->get()
            ->first();

        $formula = DB::table('formula_composicion as f')
            ->where('f.formula_id','=',$id_formula->id)
            ->join('insumo', 'f.insumo_id', 'insumo.id')
            ->select('f.insumo_id', 'insumo.descripcion', 'f.proporcion')
            ->get();

        $insumosReferencia = [];

        foreach ($formula as $key=>$value) {
            $id_insumo = $value->insumo_id;
            $proporcion = $value->proporcion;

            $insumosReferencia[$id_insumo] = $proporcion;
        }

        // Primero valido que esten ok de acuerdo a la formula
        foreach (array_merge($insumosTrazables, $insumosNoTrazables) as $index=>$value) {
            $idInsumoRecibido = $value['id_insumo_fila_insumos'];
            $stockAUtilizar = $value['stock_utilizar'];
            $proporcionEsperada = $insumosReferencia[$idInsumoRecibido];
            if ($proporcionEsperada != ($stockAUtilizar/$cantidadFabricar)) {
//       if ($proporcionEsperada != ($value['stock_utilizar']/$cantidadFabricar * 1000)) {  <---- DESCOMENTAME
                    return back()->with('error', "Cantidad de insumo: $idInsumoRecibido no respeta la formula");
            }
        }
        // Si son correctos los insumos recibidos
        $orden = new OrdenProduccion();
        $orden->producto_id = $idProducto;
        $orden->cantidad = $cantidadFabricar;
        $orden->saldo = $cantidadFabricar;
        $orden->fecha_fabricacion = $validated['fechaentrega'];
        $orden->precio_venta_por_kilo = $validated['precioxkg'];
        $orden->save();
        /* Voy creando detalles de la op por cada insumo recibido */
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
                return back()->with('error', 'Insumo insuficiente para registrar el pedido');
            }
        }

        foreach ($insumosNoTrazables as $insumo){

            if ($insumo['stock_utilizar'] > 0) {

                $opdetalle = new OrdenProduccionDetalle();
                $opdetalle->cantidad = $insumo['stock_utilizar'];
                $opdetalle->op_id = $orden->id;
                $opdetalle->save();

                $opDetalleNoTrazable = new OrdenProduccionDetalleNoTrazable();
                $opDetalleNoTrazable->op_detalle_id = $opdetalle->id;
                $opDetalleNoTrazable->insumo_id = $insumo['id_insumo_fila_insumos'];
                $opDetalleNoTrazable->cliente_id = $validated['cliente'];
                $opDetalleNoTrazable->save();
            }

            $cantidadUsarFabrica = $insumo['stock_utilizar_Fabrica'];

            // Si hay cantidad de la fabrica
            if ($cantidadUsarFabrica > 0) {
                $opdetalle = new OrdenProduccionDetalle();
                $opdetalle->cantidad = $cantidadUsarFabrica;
                $opdetalle->op_id = $orden->id;
                $opdetalle->save();

                $opDetalleNoTrazable = new OrdenProduccionDetalleNoTrazable();
                $opDetalleNoTrazable->op_detalle_id = $opdetalle->id;
                $opDetalleNoTrazable->insumo_id = $insumo['id_insumo_fila_insumos'];
                $opDetalleNoTrazable->cliente_id = 1;
                $opDetalleNoTrazable->save();

                // TODO verificar que tenga credito suficiente
                $prestamo = new PrestamoCliente();
                $prestamo->op_detalle_id = $opdetalle->id;
                $prestamo->save();
            }
        }

        return redirect()->action('OrdenProduccionController@index')->with('message','Pedido registrado con éxito!');
        /* Espero recibir una lista de insumos trazables y otra de no trazables a utilizar
         * Puede que haya insumos propios de la fabrica -> registrar prestamos
        */

        /* Si es de la fabrica, registrar prestamo vinculado a ese detalle ;
         * El trigger se encarga de tocar stock
        */

        // TODO Verificar precio fason

        // TODO Verificar capacidad productiva

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
    function getformulaProducto(Request $request){
        $id_producto = $request->get('id');
        $cantidad = $request->get('cantidad');

        $id_cliente = DB::table('alimento')->where('id', '=', $id_producto)->get()->first()->cliente_id;

        $id_formula = DB::table('alimento_formula')
            ->where('alimento_id', '=', $id_producto)
            ->where('fecha_hasta', '=', null)
            ->select('alimento_formula.id')
            ->get()
            ->first();

        $formula = DB::table('formula_composicion as f')
            ->where('f.formula_id','=',$id_formula->id)
            ->join('insumo', 'f.insumo_id', 'insumo.id')
            ->select('f.insumo_id', 'insumo.descripcion', 'f.proporcion')
            ->get();

        $rta = [];

        foreach ($formula as $key=>$value) {

            $id_insumo = $value->insumo_id;

            $is_trazable = DB::table('insumo as i')
                ->where('i.id', '=', $id_insumo)
                ->join('insumo_trazable', 'insumo_trazable.id', '=', 'i.id')
                ->exists();

            $proporcion = $value->proporcion;

            $element = [];
            $element['id_insumo'] = $id_insumo;
            $element['nombre_insumo'] = $value->descripcion;
            $element['cantidad_requerida'] = $proporcion * $cantidad;

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
