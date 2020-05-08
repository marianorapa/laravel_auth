<?php

namespace App\Http\Controllers;

use App\Localidad;
use Illuminate\Http\Request;

class LocalidadController extends Controller
{
    //

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getLocalidad(Request $request){
        $id = $request->get('provincia_id');

        $localidades = Localidad::where('provincia_id',"=",$id)->get();
        foreach ($localidades as $localidad) {
            $localidadArray[$localidad->id] = $localidad->descripcion;
        }

        return response()->json($localidadArray);
    }
}
