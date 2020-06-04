<?php

namespace App\Http\Controllers;

use App\CapacidadProductiva;
use App\Utils\CapacidadProductivaManager;
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
            'precio_por_tn' => ['required','numeric'],
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
            'tipo_capacidad' => ['required'],
            'fecha_desde' => ['required', 'date', 'after:' . date('d.m.Y',strtotime("-1 days"))]
        ]);

        $nuevaCap = new CapacidadProductiva();
        $nuevaCap->fecha_desde = $validated['fecha_desde'];
        $nuevaCap->capacidad = $validated['capacidad'];

        if ($validated['tipo_capacidad'] == 'temporal'){
            $fecha_hasta = $request->validate([
                'fecha_hasta' => ['required']
            ]);
            $nuevaCap->fecha_hasta = $fecha_hasta['fecha_hasta'];
            $nuevaCap->prioridad_id = 1; // Prioridad temporal para evitar null
            if (!$nuevaCap->save()){
                return back()->with('error', 'Ya existe una capacidad con prioridad ALTA para esa fecha');
            }
            return redirect()->action('ParametrosController@indexCapacidad')
                ->with('message', 'Capacidad temporal registrada');
        }

        $nuevaCap->prioridad_id = 2;
        $nuevaCap->save(); // Se encarga de "finalizar", poner en null, la capacidad permanente anterior.
        return redirect()->action('ParametrosController@indexCapacidad')
            ->with('message', 'Capacidad permanente registrada');

    }


    public function getCapacidadRestante(Request $request){
        $fecha = $request->get('fecha');

        $capacidad = CapacidadProductivaManager::getCapacidadRestante($fecha);

        return response()->json($capacidad);
    }

}
