<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresasController extends Controller
{
    //
    public function index(){

        $proveedores = DB::table('empresa as e')->join('proveedor as p', 'p.id', 'e.id')
            ->select('e.id', 'e.denominacion', 'e.fecha_inicio_actividades', 'p.gln',
                DB::raw("'Proveedor' as tipo"));

        $clientes = DB::table('empresa as e')->join('cliente as c', 'c.id', 'e.id')->select()
            ->select('e.id', 'e.denominacion', 'e.fecha_inicio_actividades',
                DB::raw('null as col1'), DB::raw("'Cliente' as tipo"));

        $transportistas = DB::table('empresa as e')->join('transportista as t', 't.id', 'e.id')
            ->select('e.id', 'e.denominacion', 'e.fecha_inicio_actividades',
                DB::raw('null as col1'), DB::raw("'Transporte' as tipo"));

        $empresas = $proveedores->union($clientes)->union($transportistas)->get();

        return view('administracion.empresas.index', compact('empresas'));
    }


}
