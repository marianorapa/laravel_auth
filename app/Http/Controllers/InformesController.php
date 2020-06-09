<?php

namespace App\Http\Controllers;

use App\Utils\InformesManager;
use Illuminate\Http\Request;

class InformesController extends Controller
{
    //

    public function informeEstadistico(){
        return view('gerencia.informes.estadistico');
    }

    public function generarInformeEstadistico(Request $request){
        $desde = $request->get('desde');
        $hasta = $request->get('hasta');

        $informe = InformesManager::getInformeEstadistico($desde, $hasta);
        $informe['desde'] = $desde;
        $informe['hasta'] = $hasta;

        return view('gerencia.informes.estadisticoGenerado', compact('informe'));
    }

}
