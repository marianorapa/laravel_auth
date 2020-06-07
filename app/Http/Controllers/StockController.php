<?php

namespace App\Http\Controllers;

use App\Utils\StockManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('permission');
    }

    public function index(){
        return view('administracion.stock.index');
    }

    public function indexInsumos(Request $request){

        $cliente = $request->get('cliente');

        $insumos = StockManager::getListadoStockInsumos($cliente);

        return view('administracion.stock.insumos.index', compact('insumos'));
    }

    public function indexProductos(Request $request){

        $cliente = $request->get('cliente');
        $productos = StockManager::getListadoStockProductos($cliente);

        return view('administracion.stock.productos.index', compact('productos'));
    }

    public function actualizarStockInsumoNoTrazable($id_cliente, $id_insumo){
        $insumo = [];

        $insumoDb = DB::table('insumo')->find($id_insumo)->descripcion;
        $clienteDb = DB::table('empresa')->find($id_cliente)->denominacion;

        if (!is_null($insumoDb)) {

            $insumo['idInsumoNt'] = $id_insumo;
            $insumo['nombreInsumo'] = $insumoDb;
            $insumo['idCliente'] = $id_cliente;
            $insumo['nombreCliente'] = $clienteDb;
            $insumo['stock'] = StockManager::getStockInsumoNoTrazableCliente($id_insumo, $id_cliente);

            return view('administracion.stock.insumos.aumentar', compact('insumo'));
        }
        return back()->with('error', 'No existe el insumo!');
    }


    public function actualizarStockInsumoTrazable($idCliente, $idLoteInsumoEspecifico){
        $clienteDb = DB::table('empresa')->find($idCliente)->denominacion;
        $loteInsumoDb = DB::table('lote_insumo_especifico as lie')
            ->join('insumo_especifico as ie', 'ie.gtin', 'lie.insumo_especifico')
            ->join('insumo as i', 'i.id', 'ie.insumo_trazable_id')
            ->select('i.descripcion', 'lie.nro_lote')->get()->first();

        $insumo = [];
        $insumo['idLoteInsumoEspecifico'] = $idLoteInsumoEspecifico;
        $insumo['nombreInsumo'] = $loteInsumoDb->descripcion;
        $insumo['nroLote'] = $loteInsumoDb->nro_lote;
        $insumo['idCliente'] = $idCliente;
        $insumo['nombreCliente'] = $clienteDb;
        $insumo['stock'] = StockManager::getStockIdLoteCliente($idCliente, $idLoteInsumoEspecifico);

        return view('administracion.stock.insumos.aumentar', compact('insumo'));
    }

    public function registrarAjusteTrazable($idLoteInsumo, $idCliente, Request $request){
        $validated = $request->validate([
           'ajuste' => ['numeric', 'required']
        ]);

        $ajuste = $validated['ajuste'];
        $stockActual = StockManager::getStockIdLoteCliente($idCliente, $idLoteInsumo);

        if ($stockActual + $ajuste < 0) {
            return back()->with('error', 'El stock no puede quedar negativo');
        }

        StockManager::ajusteStockInsumoTrazable($idLoteInsumo, $idCliente, $ajuste);

        return redirect()->action('StockController@indexInsumos')->with('message', 'Ajuste realizado con éxito');
    }

    public function registrarAjusteNoTrazable($idInsumo, $idCliente, Request $request){
        $validated = $request->validate([
            'ajuste' => ['numeric', 'required']
        ]);

        $ajuste = $validated['ajuste'];

        $stockActual = StockManager::getStockInsumoNoTrazableCliente($idInsumo, $idCliente);

        if ($stockActual + $ajuste < 0){
            return back()->with('error', 'El stock no puede quedar negativo');
        }

        StockManager::ajusteStockInsumoNoTrazable($idInsumo, $idCliente, $ajuste);

        return redirect()->action('StockController@indexInsumos')->with('message', 'Ajuste realizado con éxito');
    }

    public function aumentarStockProducto($id){

    }


}
