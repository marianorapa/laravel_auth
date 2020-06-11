<?php

namespace App\Http\Controllers;

use App\Utils\InformesManager;
use Illuminate\Http\Request;

class InformesController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('permission');
    }


    public function informeEstadistico(){
        return view('gerencia.informes.estadistico');
    }

    public function generarInformeEstadistico(Request $request){
        $validated = $request->validate([
            'desde' => 'required | date',
            'hasta' => 'required | date'
        ]);

        $desde = $validated['desde'];
        $hasta = $validated['hasta'];

        $informe = InformesManager::getInformeEstadistico($desde, $hasta);
        $informe['desde'] = $desde;
        $informe['hasta'] = $hasta;

        return view('gerencia.informes.estadisticoGenerado', compact('informe'));
    }

}
