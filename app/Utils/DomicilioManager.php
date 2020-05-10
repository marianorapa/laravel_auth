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

    public static function store($request, &$domicilio)
    {
        $validatedDomicilio = $request->validate([
            'calle' => ['required'],
            'numero' => ['required', 'numeric'],
            'piso' => ['nullable','numeric'],
            'dpto' => ['nullable','alpha_num'],
            'localidad' => ['required','exists:localidad,id']
        ]);
        $localidad = Localidad::all()->where('id',$validatedDomicilio['localidad'])->first();

        $domicilio = new Domicilio();
        $domicilio->fill($validatedDomicilio);
        $domicilio->localidad()->associate($localidad);
        $domicilio->save();
    }

    public static function update($validatedDomicilio, &$domicilio)
    {
        $localidad = Localidad::all()->where('id',$validatedDomicilio['localidad'])->first();
//        $domicilio = Domicilio::withTrashed()->findOrFail($id_domicilio);
        $domicilio->fill($validatedDomicilio);
        $domicilio->localidad()->associate($localidad);
        $domicilio->save();
    }
}
