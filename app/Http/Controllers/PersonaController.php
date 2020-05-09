<?php

namespace App\Http\Controllers;
use App\Domicilio;
use App\PersonaTipo;
use App\TipoDocumento;
use App\Utils\PersonaManager;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Persona;
use App\Provincia;
use App\localidad;

class PersonaController extends Controller
{

    public function __construct()
    {
//        $this->middleware('App\Http\Middleware\IsAdmin');
        $this->middleware('permission');

    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *  @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $name = $request->get('name');
        $nrdoc= $request->get('nrodocumento');
        $apellido = $request->get('apellido');
//        $personas = Persona::all();


        $personas = Persona::withTrashed()
                            ->name($name)
                            ->apellido($apellido)
                            ->nrodoc($nrdoc)
                            ->get();
        return view('admin.personas.index', compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.personas.create');
    }


    /**
     * Store a newly created resource in storage.
     * Returns the inserted person as second argument
     * @param  \Illuminate\Http\Request  $request
     * @param Persona $persona
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Checks if it already exists
        $personaExistente = Persona::withTrashed()->join('persona_tipo','personas.id', 'persona_tipo.id')
            ->where('nro_documento', $request->get('nro_documento'))
            ->where('tipo_documento_id', $request->get('id_tipo_documento'))
            ->get()->first();

        // If it doesn't, stores the new one
        if ($personaExistente == null) {
            $persona = new Persona();
            PersonaManager::store($request, $persona);
            return back()->with('mensaje', 'Persona creada.');
        }

        // If it does exist, return the existing person
        if ($personaExistente->trashed()){
            //$personaExistente->restore(); Upd. no la activa. Informa que no puede creerse
            return back()->with('error', 'La persona con ese documento ya existe y esta desactivada.');
        }

        return back()->with('error', 'Ya existe una persona activa con el documento ingresado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona = Persona::withTrashed()->findOrFail($id);

        return view('admin.personas.edit', compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $persona = Persona::withTrashed()->findOrFail($id);
        // Se fija que exista.

        if ($persona != null){
            PersonaManager::update($request, $persona);
            return back()->with('mensaje', 'Persona actualizada');
        }

        return back()->with('mensaje', 'Persona inexistente');
        /*$validatedData = $request->validate([
            'nombresPersona' => 'required',
            'apellidos' => 'required',
            'descr' => 'required',
            'fechaNac' => 'required',
            'direccion' => 'required',
            'tel' => 'required',
            'tipoDoc' => 'required',
            'nroDocumento' => 'required'
        ]);*/

        /*$persona->fill([
            'apellidos'=>$validatedData['apellidos'],
            'nombres'=>$validatedData['nombresPersona'],
            'tipoDoc'=>$validatedData['tipoDoc'],
            'nroDocumento'=>$validatedData['nroDocumento'],
            'fechaNacimiento'=>$validatedData['fechaNac'],
            'descripcion'=>$validatedData['descripcion'],
            'domicilio'=>$validatedData['domicilio'],
            'telefono'=>$validatedData['tel'],
        ]);*/

        /*$persona->nombres = $request['nombresPersona'];
        $persona->apellidos = $request['apellidos'];
        $persona->descripcion = $request['descr'];
        $persona->fechaNacimiento = $request['fechaNac'];
        $persona->domicilio = $request['direccion'];
        $persona->telefono = $request['tel'];
        $persona->tipoDoc = $request['tipoDoc'];
        $persona->nroDocumento = $request['nroDocumento'];*/

        //$persona->save();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $personaEliminar = Persona::findOrFail($id);
        $usuario = Auth::id();
        $id_persona = $personaEliminar->id;
        if ($usuario == $id_persona ){
            return  back()->with('error','No se pudo desactivar la persona.');

        }
        $personaEliminar->delete();
        return back()->with('mensaje','Se desactivó a la persona del sistema');




    }


    public function activate($id)
    {
        $persona = Persona::withTrashed()->findOrFail($id);
        $persona->restore();

        return back()->with('mensaje', 'Se activó a la persona nuevamente');
    }


        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buscadorprovincia(Request $request){

    }

}
