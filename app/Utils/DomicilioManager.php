<?php

namespace App\Utils;

use App\Domicilio;
use App\Localidad;
use App\Provincia;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

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
}
