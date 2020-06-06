<?php

namespace App\Http\Controllers;

use App\Utils\StockManager;
use Illuminate\Http\Request;

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



}
