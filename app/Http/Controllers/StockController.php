<?php

namespace App\Http\Controllers;

use App\Utils\StockManager;
use Illuminate\Http\Request;

class StockController extends Controller
{
    //

    public function index(){
        return view('administracion.stock.index');
    }

    public function indexInsumos(){
        $insumos = StockManager::getListadoStockInsumos();

        return view('administracion.stock.insumos.index', compact('insumos'));
    }

    public function indexProductos(){
        $productos = StockManager::getListadoStockProductos();

        return view('administracion.stock.productos.index', compact('productos'));
    }



}
