<?php

namespace App\Http\Controllers;

use App\CapacidadProductiva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParametrosController extends Controller
{
    //
    public function index(){
        return view('gerencia.parametrosProductivos.gestionParametrosProductivos');
    }

    public function indexPrecio(){
        return view('gerencia.parametrosProductivos.precio.index');
    }

    public function definirPrecio(){
        return view('gerencia.parametrosProductivos.precio.precioXkg');
    }

    public function registrarPrecio(Request $request){
        $validated = $request->validate([
            'precio_por_kilo' => ['required','numeric'],
            'variacion' => ['required'],
            'fecha_desde' => ['required', 'date'],
            'fecha_hasta' => ['required', 'date']
        ]);

        dd($validated);
        /* TODO registrar precio */
    }


    public function indexCapacidad(){

        $capacidadHistorico = DB::table('capacidad_productiva as c')
            ->orderBy('c.created_at')
            ->select('c.id', 'c.capacidad', 'c.fecha_desde', 'c.fecha_hasta', 'c.prioridad_id')
            ->get();

        return view('gerencia.parametrosProductivos.capacidad.index', compact('capacidadHistorico'));
    }

    public function definirCapacidad(){
        return view('gerencia.parametrosProductivos.capacidad.capacidadProductiva');
    }

    public function registrarCapacidad(Request $request){
        $validated = $request->validate([
            'capacidad' => ['required', 'numeric'],
            'fecha_desde' => ['required', 'date'],
            'fecha_hasta' => ['required', 'date'],
        ]);

        dd($validated);

        /* TODO registrar capacidad */
    }



}
