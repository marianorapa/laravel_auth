<?php

namespace App\Http\Controllers;

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
            ->join('cliente','alimento.cliente_id','=','cliente.id')
            ->select('orden_de_produccion.id as op_id','cliente.id as cliente_id ','orden_de_produccion.fecha_fabricacion','alimento.id as alimento_id','orden_de_produccion.cantidad')
            ->get();//no se que son las acciones, me faltan en esta consulta.

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
        dd($request);
        $validated = $request->validate([
            'producto' => ['required', 'exists:alimento'],
            'cantidad' => ['required', 'numeric'],
            'fechaentrega' => ['required', 'date'],
            'precioxkg' => ['required', 'numeric']
        ]);

        /* Espero recibir una lista de insumos trazables y otra de no trazables a utilizar
         * Puede que haya insumos propios de la fabrica -> registrar prestamos
        */

        /* Voy creando detalles de la op por cada insumo recibido */

        /* Si es de la fabrica, registrar prestamo vinculado a ese detalle ; El trigger se encarga de tocar stock */
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
//        $id_producto = $request->get('id');
//        $cantidad = $request->get('cantidad');

        $id_producto = 1;
        $cantidad = 100;

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

        foreach ($formula as $key=>$value){

            $id_insumo = $value->insumo_id;

            $is_trazable = DB::table('insumo as i')
                        ->where('i.id','=',$id_insumo)
                        ->join('insumo_trazable','insumo_trazable.id','=','i.id')
                        ->exists();

            $proporcion = $value->proporcion;

            $element = [];
            $element['id_insumo'] = $id_insumo;
            $element['nombre_insumo'] = $value->descripcion;
            $element['cantidad_requerida'] = $proporcion * $cantidad;

            if ($is_trazable) {

                $lotes = StockManager::getLotesStockCliente($id_insumo, $id_cliente);
                $element['lotes'] = $lotes;
            }
            else {
                $element['stock_cliente'] = StockManager::getStockInsumoNoTrazableCliente($id_insumo, $id_cliente);
                $element['stock_fabrica'] = StockManager::getStockInsumoFabrica($id_insumo);
                $element['limite_cliente'] = PrestamosManager::getLimiteRestanteCliente($id_cliente);
            }

            $rta[] = $element;
        }

//        $json = response()->json($rta)->getData();

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
