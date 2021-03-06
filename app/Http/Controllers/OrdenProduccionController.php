<?php

namespace App\Http\Controllers;

use App\EstadoOpOrdenProduccion;
use App\EstadoOrdenProduccion;
use App\OrdenProduccion;
use App\OrdenProduccionDetalle;
use App\OrdenProduccionDetalleNoTrazable;
use App\OrdenProduccionDetalleTrazable;
use App\PrestamoCliente;
use App\Utils\CapacidadProductivaManager;
use App\Utils\PrecioManager;
use App\Utils\PrestamosManager;
use App\Utils\StockManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdenProduccionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $producto = $request->get('producto');
        $cliente = $request->get('cliente');

        $ops = $this->getAllOps($producto, $cliente);

        return view('administracion.pedidos.index', compact('ops', 'producto', 'cliente'));
    }

    /**
     * @param $producto
     * @param $cliente
     * @return array
     */
    protected function getAllOps($producto, $cliente): array
    {
        return DB::select(DB::raw("select op.id as op_id,
               empresa.denominacion as empresa,
               op.fecha_fabricacion,
               alimento.descripcion as producto,
               op.cantidad, eop.descripcion
                from orden_de_produccion as op
                inner join alimento on op.producto_id = alimento.id AND alimento.descripcion LIKE '%$producto%'
                inner join empresa on alimento.cliente_id = empresa.id AND empresa.denominacion LIKE '%$cliente%'
                inner join (SELECT ord_pro_id, max(estado_id) as estado_id FROM estado_op_orden_de_produccion
                    GROUP BY ord_pro_id) as e on e.ord_pro_id = op.id
                inner join estado_ord_pro as eop on eop.id = e.estado_id
                order by op_id desc"));
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
            ->join('empresa', 'cliente.id', '=', 'empresa.id')
            ->select('cliente.id', 'empresa.denominacion')->get();

        $precioFason = PrecioManager::getPrecioReferencia();

        return view('administracion.pedidos.altaPedidosNew', compact('clientes', 'precioFason'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'cliente' => ['required', 'exists:cliente,id'],
            'producto' => ['required', 'exists:alimento,id'],
            'cantidad' => ['required', 'numeric', 'integer', 'min:0'],
            'fechaentrega' => ['required', 'date', 'after:tomorrow'],
            'precioxkg' => ['required', 'numeric']
        ]);

        $insumosTrazables = $request->insumos_trazables;
        $insumosNoTrazables = $request->insumos_no_trazables;

        $idClienteOrden = $validated['cliente'];
        $idProducto = $validated['producto'];
        $cantidadFabricar = $validated['cantidad'];
        $fechaEntrega = $validated['fechaentrega'];
        $precioXtn = $validated['precioxkg'];

        $id_formula = DB::table('alimento_formula')
            ->where('alimento_id', '=', $idProducto)
            ->where('fecha_hasta', '=', null)
            ->select('alimento_formula.id')
            ->get()
            ->first();

        $formula = DB::table('formula_composicion as f')
            ->where('f.formula_id', '=', $id_formula->id)
            ->join('insumo', 'f.insumo_id', 'insumo.id')
            ->select('f.insumo_id', 'insumo.descripcion', 'f.kilos_por_tonelada')
            ->get();

        $insumosReferencia = [];

        foreach ($formula as $key => $value) {
            $id_insumo = $value->insumo_id;
            $kilos_por_tonelada = $value->kilos_por_tonelada;
            $insumosReferencia[$id_insumo] = $kilos_por_tonelada;
        }

        foreach ($insumosTrazables as $value) {
            $idInsumoRecibido = $value['id_insumo_fila_insumos'];
            $stockAUtilizar = is_null($value['stock_utilizar']) ? 0 : $value['stock_utilizar'];
            $loteAUtilizar = isset($value['lote_insumo']) ? $value['lote_insumo'] : 0;
            $nombreInsumo = DB::table('insumo')->find($idInsumoRecibido)->descripcion;

            if ($this->cumpleProporcion($idInsumoRecibido, $stockAUtilizar, $cantidadFabricar, $insumosReferencia)) {
                if (!$this->alcanzaStockTrazable($idClienteOrden, $idInsumoRecibido, $loteAUtilizar, $stockAUtilizar)) {
                    return back()->with('error', "Cantidad de lote $loteAUtilizar de $nombreInsumo insuficiente");
                }
            } else {
                return back()->with('error', "La cantidad $stockAUtilizar kg de $nombreInsumo no respeta la fórmula");
            }
        }

        foreach ($insumosNoTrazables as $value) {
            $idInsumoRecibido = $value['id_insumo_fila_insumos'];
            $stockAUtilizar = is_null($value['stock_utilizar']) ? 0 : $value['stock_utilizar'];
            $stockAUtilizarFabrica = is_null($value['stock_utilizar_Fabrica']) ? 0 : $value['stock_utilizar_Fabrica'];
            $nombreInsumo = DB::table('insumo')->find($idInsumoRecibido)->descripcion;

            if (key_exists($idInsumoRecibido, $insumosReferencia)) {
                if ($this->cumpleProporcion($idInsumoRecibido, $stockAUtilizar + $stockAUtilizarFabrica,
                    $cantidadFabricar, $insumosReferencia)) {

                    if ($this->alcanzaStockNoTrazableCliente($idClienteOrden, $idInsumoRecibido, $stockAUtilizar)) {
                        if (!$this->alcanzaStockFabrica($idInsumoRecibido, $stockAUtilizarFabrica)) {
                            return back()->with('error', "Cantidad INSUFICIENTE de $nombreInsumo de la fabrica.");
                        } else {
                            if (!$this->tieneCreditoCliente($idClienteOrden, $stockAUtilizarFabrica)) {
                                return back()->with('error', "El cliente no tiene crédito suficiente para $nombreInsumo.");
                            }
                        }
                    } else {
                        return back()->with('error', "Cantidad INSUFICIENTE de $nombreInsumo del cliente.");
                    }
                } else {
                    return back()->with('error', "Cantidad de $nombreInsumo no respeta la fórmula.");
                }
            } else {
                return back()->with('error', "Insumo $nombreInsumo no pertenece a la fórmula.");
            }
        }

        if (!CapacidadProductivaManager::existeCapacidadProductiva($fechaEntrega, $cantidadFabricar)) {
            return back()->with('error', "No hay suficiente capacidad productiva
                                            restante para la fecha seleccionada");
        }

        if (!PrecioManager::isPrecioValido($precioXtn)) {
            return back()->with('error', "El precio ingresado no es válido.")->with(compact('validated'));//////////////////////////////////////////////////////
        }


        // Si son correctos los insumos recibidos
        $orden = new OrdenProduccion();
        $orden->producto_id = $idProducto;
        $orden->cantidad = $cantidadFabricar;
        $orden->saldo = $cantidadFabricar;

        $orden->fecha_fabricacion = $fechaEntrega;
        $orden->precio_venta_por_tn = $precioXtn;
        $orden->save();

        /* Voy creando detalles de la op por cada insumo trazable recibido */
        foreach ($insumosTrazables as $insumo) {
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
            } else {
                // Si no existe lote
                return back()->with('error', 'Insumo insuficiente para registrar el pedido');
            }
        }

        /* Voy creando detalles de la op por cada insumo no trazable recibido */
        foreach ($insumosNoTrazables as $insumo) {

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
                $prestamo->op_detalle_id = $opDetalleNoTrazable->id;
                $prestamo->cancelado = 0;
                $prestamo->save();
            }
        }

        return redirect()->action('OrdenProduccionController@index')
            ->with('message', 'Pedido registrado con éxito!');

    }

    public function cumpleProporcion($idInsumoRecibido, $stockAUtilizar, $cantidadFabricar, $insumosReferencia)
    {
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
     * Finalize the specified order
     *
     * @param int $id The order's id
     */
    public function finalize($id)
    {
        $op = OrdenProduccion::findOrFail($id);

        if ($op->isPendiente()) {
            $estadoOpOrden = new EstadoOpOrdenProduccion();
            $estadoOpOrden->estado_id = EstadoOrdenProduccion::getEstadoFinalizada()->id;
            $estadoOpOrden->ord_pro_id = $id;
            $estadoOpOrden->user()->associate(Auth::user()); // Cambiado
            $estadoOpOrden->save();
            return redirect()->action('OrdenProduccionController@index')
                ->with('message', 'Orden finalizada con éxito.');
        }

        /* Si la op estaba finalizada o anulada, no puede finalizarse de nuevo */
        return redirect()->action('OrdenProduccionController@index')
            ->with('error', 'La orden no pudo finalizarse.');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $pedidosnt = DB::table('orden_de_produccion as op')
            ->where('op.id', '=', $id)
            ->join('orden_de_produccion_detalle as detalle', 'op.id', 'detalle.op_id')
            ->join('op_detalle_no_trazable as nt', 'detalle.id', 'nt.op_detalle_id')
            ->join('insumo', 'insumo.id', 'nt.insumo_id')
            ->join('empresa', 'empresa.id', 'nt.cliente_id')
            ->join('alimento', 'alimento.id' , 'op.producto_id')
            ->select('op.id', 'op.cantidad', 'op.producto_id', 'op.saldo' , 'op.fecha_fabricacion' , 'op.precio_venta_por_tn', 'op.destino', 'op.created_at',
                'detalle.cantidad as cant', 'detalle.id as prod_id', 'nt.cliente_id', 'alimento.descripcion as prod', 'insumo.descripcion', 'empresa.denominacion as nombre_cliente')
            ->get();


        $pedidost = DB::table('orden_de_produccion as op')
            ->where('op.id', '=', $id)
            ->join('orden_de_produccion_detalle as detalle', 'op.id', 'detalle.op_id')
            ->join('op_detalle_trazable as opt', 'detalle.id', 'opt.op_detalle_id')
            ->join('lote_insumo_especifico as lote', 'lote.id', 'opt.lote_insumo_id')
            ->join('insumo_especifico as insumo', 'lote.insumo_especifico', 'insumo.gtin')
            ->join('lote_insumo_especifico as detallelote', 'detallelote.id', 'opt.lote_insumo_id')
            ->select('insumo.gtin', 'insumo.descripcion', 'detalle.cantidad', 'detallelote.nro_lote')
            ->get();
        return view('administracion.pedidos.verPedido',compact('pedidosnt','pedidost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }


    /**
     * Sets the state of the order to Cancelled
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel($id)
    {
        $op = OrdenProduccion::find($id);
        if ($op->isPendiente()) {
            $op->anularOrden();
            return back()->with('message', 'La orden se ha anulado');
        } else {
            return back()->with('error', 'Una orden finalizada no puede anularse.');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    function getProductoCliente(Request $request)
    {
        $id_cliente = $request->get('id');

        $productos = DB::table('alimento')
            ->where('cliente_id', '=', $id_cliente)->get();
        return response()->json($productos);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    function getClienteProdForm(Request $request)
    {
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    function getFabricaProdForm(Request $request)
    {
        $id_producto = $request->get('id_prod');
        $id_cliente = $request->get('id_cliente');

        /*$formula = DB::table('')
            ->join('movimiento_insumo','movimiento_insumo.cliente_id','=',$id_cliente)
            ->join()
            ->select('cliente.id','empresa.denominacion')->get();*/
        return response()->json();
    }


    function getSaldoOp(Request $request)
    {

        $op_id = $request->get('op_id');

        $saldo = DB::table('orden_de_produccion')->where('id', '=', $op_id)
            ->select('saldo')->get();

        return response()->json($saldo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function getPdfAll($cliente = "", $producto = "")
    {

       $pedidos = $this->getAllOps($producto, $cliente);

        return view('administracion.pedidos.pedidos-list-re', compact('pedidos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getpedidosjs(Request $request)
    {
        $pedidos = DB::table('orden_de_produccion')
            ->select('producto_id', 'cantidad')
            ->get();
        return response()->json(json_encode($pedidos));
    }



    public function getPdfOne($id)
    {
        $pedidosnt = DB::table('orden_de_produccion as op')
            ->where('op.id', '=', $id)
            ->join('orden_de_produccion_detalle as detalle', 'op.id', 'detalle.op_id')
            ->join('op_detalle_no_trazable as nt', 'detalle.id', 'nt.op_detalle_id')
            ->join('insumo', 'insumo.id', 'nt.insumo_id')
            ->join('empresa', 'empresa.id', 'nt.cliente_id')
            ->join('alimento', 'alimento.id' , 'op.producto_id')
            ->select('op.id', 'op.cantidad', 'op.producto_id', 'op.saldo' , 'op.fecha_fabricacion' , 'op.precio_venta_por_tn', 'op.destino', 'op.created_at',
            'detalle.cantidad as cant', 'detalle.id as prod_id', 'nt.cliente_id', 'alimento.descripcion as prod', 'insumo.descripcion', 'empresa.denominacion as nombre_cliente')
            ->get();


            $pedidost = DB::table('orden_de_produccion as op')
            ->where('op.id', '=', $id)
            ->join('orden_de_produccion_detalle as detalle', 'op.id', 'detalle.op_id')
            ->join('op_detalle_trazable as opt', 'detalle.id', 'opt.op_detalle_id')
            ->join('lote_insumo_especifico as lote', 'lote.id', 'opt.lote_insumo_id')
            ->join('insumo_especifico as insumo', 'lote.insumo_especifico', 'insumo.gtin')
            ->join('lote_insumo_especifico as detallelote', 'detallelote.id', 'opt.lote_insumo_id')
            ->select('insumo.gtin', 'insumo.descripcion', 'detalle.cantidad', 'detallelote.nro_lote')
            ->get();

        return view('administracion.pedidos.pedidos-unitlist', compact('pedidosnt', 'pedidost'));



    }

}
