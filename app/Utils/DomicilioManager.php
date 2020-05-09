<?php

namespace App\Utils;

use App\Domicilio;
use App\Localidad;
use App\Provincia;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DomicilioManager
{

    public static function store($validatedDomicilio, &$domicilio)
    {
        $localidad = Localidad::all()->where('descripcion',$validatedDomicilio['localidad'])->first();

        $domicilio = new Domicilio();
        $domicilio->fill($validatedDomicilio);
        $domicilio->localidad()->associate($localidad);
        $domicilio->save();
    }
    public static function update($validatedDomicilio, &$domicilio,$id_domicilio)
    {
        $localidad = Localidad::all()->where('descripcion',$validatedDomicilio['localidad'])->first();
        $domicilio = Domicilio::withTrashed()->findOrFail($id_domicilio);
        $domicilio->fill($validatedDomicilio);
        $domicilio->localidad()->associate($localidad);
        $domicilio->save();
    }
}
