<?php


namespace App\Utils;


use App\Domicilio;
use App\Localidad;
use App\Persona;
use App\PersonaTipo;
use App\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Query\Builder;

class PersonaManager
{

    public static function store(Request $request, Persona &$persona){
        $validatedPersonaTipo = $request->validate([
            'id_tipo_documento' => ['required', 'exists:tipo_documento,id'],
            'nro_documento' => ['required'],
//            'id_tipo_documento,nro_documento' => ['unique'], se podra??
            'email' => ['required', 'string', 'email', 'max:255'],
            'telefono' => ['required'],
            'observaciones' => ['nullable', 'string']
        ]);

        $validatedPersona = $request->validate([
            'nombres' => ['required'],
            'apellidos' => ['required'],
            'fecha_nacimiento' => ['required','date','before:-20 years']
        ]);

        $validatedDomicilio = $request->validate([
            'calle' => ['required'],
            'numero' => ['required', 'numeric'],
            'piso' => ['nullable','numeric'],
            'dpto' => ['nullable','alpha_num'],
            'localidad' => ['required','exists:localidad,descripcion']
        ]);

        DomicilioManager::update($validatedDomicilio, $domicilio);

        $tipoDocumento = TipoDocumento::findOrFail($validatedPersonaTipo['id_tipo_documento']);

        $persona_tipo = new PersonaTipo();
        $persona_tipo->fill($validatedPersonaTipo);
        $persona_tipo->tipoDocumento()->associate($tipoDocumento);
        $persona_tipo->domicilio()->associate($domicilio);
        $persona_tipo->save();

        // Creo una persona con los datos ingresados
        $persona = new Persona();
        $persona->fill($validatedPersona);
        $persona->personaTipo()->associate($persona_tipo);
        $persona->save();
    }

    public static function update(Request $request, Persona &$persona, $id){

        $validatedPersonaTipo = $request->validate([
            'id_tipo_documento' => ['required', 'exists:tipo_documento,id'],
            'nro_documento' => ['required'],
//            'id_tipo_documento,nro_documento' => ['unique'], se podra??
            'email' => ['required', 'string', 'email', 'max:255'],
            'telefono' => ['required'],
            'observaciones' => ['nullable', 'string']
        ]);

        $validatedPersona = $request->validate([
            'nombres' => ['required'],
            'apellidos' => ['required'],
            'fecha_nacimiento' => ['required','date','before:-20 years']
        ]);

        $validatedDomicilio = $request->validate([
            'calle' => ['required'],
            'numero' => ['required', 'numeric'],
            'piso' => ['nullable','numeric'],
            'dpto' => ['nullable','alpha_num'],
            'localidad' => ['required','exists:localidad,descripcion']
        ]);

        $persona_tipo = PersonaTipo::find($id);

        $id_domcilio = $persona_tipo->domicilio_id();
        DomicilioManager::store($validatedDomicilio, $domicilio, $id_domcilio);

        $tipoDocumento = TipoDocumento::findOrFail($validatedPersonaTipo['id_tipo_documento']);


        $persona_tipo->fill($validatedPersonaTipo);
        $persona_tipo->tipoDocumento()->associate($tipoDocumento);
        $persona_tipo->domicilio()->associate($domicilio);
        $persona_tipo->save();

        // Creo una persona con los datos ingresados
        $persona_edit = Persona::withTrashed()->findOrFail($id);
        $persona_edit->fill($validatedPersona);
        //$persona->personaTipo()->associate($persona_tipo);
        $persona_edit->save();
    }


}
