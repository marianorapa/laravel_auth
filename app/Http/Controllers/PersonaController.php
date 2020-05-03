<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'apellidos' => 'required',
            'nombresPersona' => 'required',
            'tipoDoc' => 'required',
            'nroDocumento' => 'required',
            'fechaNac' => 'required',
            'descr' => 'required',
            //'direccion' => 'required',
            'tel' => 'required',
        ]);

        $persona = new Persona();
        $persona->fill([
            'apellidos'=>$validatedData['apellidos'],
            'nombres'=>$validatedData['nombresPersona'],
            'tipoDoc'=>$validatedData['tipoDoc'],
            'nroDocumento'=>$validatedData['nroDocumento'],
            'fechaNacimiento'=>$validatedData['fechaNac'],
            'descripcion'=>$validatedData['descr'],
            //'domicilio'=>$validatedData['direccion'],
            'telefono'=>$validatedData['tel'],
        ]);

        /*$persona->nombres = $request['nombresPersona'];
        $persona->apellidos = $request['apellidos'];
        $persona->descripcion = $request['descr'];
        $persona->fechaNacimiento = $request['fechaNac'];
        $persona->domicilio = $request['direccion'];
        $persona->telefono = $request['tel'];
        $persona->tipoDoc = $request['tipoDoc'];
        $persona->nroDocumento = $request['nroDocumento'];*/

        // Checks if it already exists
        $personaExistente = Persona::withTrashed()->where('nroDocumento', $persona->nroDocumento)->get()->first();

        // If it doesn't, stores the new one
        if ($personaExistente == null) {
            $persona->save();
            return back()->with('mensaje', 'Persona creada.');
        }

        if ($personaExistente->trashed()){
            $personaExistente->restore();
            return back()->with('mensaje', 'La persona con ese documento ya existía y ha sido activada nuevamente.');
        }

        return back()->with('mensaje', 'Ya existe una persona activa con el documento ingresado.');
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

        $validatedData = $request->validate([
            'nombresPersona' => 'required',
            'apellidos' => 'required',
            'descr' => 'required',
            'fechaNac' => 'required',
            'direccion' => 'required',
            'tel' => 'required',
            'tipoDoc' => 'required',
            'nroDocumento' => 'required'
        ]);

        $persona->fill([
            'apellidos'=>$validatedData['apellidos'],
            'nombres'=>$validatedData['nombresPersona'],
            'tipoDoc'=>$validatedData['tipoDoc'],
            'nroDocumento'=>$validatedData['nroDocumento'],
            'fechaNacimiento'=>$validatedData['fechaNac'],
            'descripcion'=>$validatedData['descripcion'],
            'domicilio'=>$validatedData['domicilio'],
            'telefono'=>$validatedData['tel'],
        ]);

        /*$persona->nombres = $request['nombresPersona'];
        $persona->apellidos = $request['apellidos'];
        $persona->descripcion = $request['descr'];
        $persona->fechaNacimiento = $request['fechaNac'];
        $persona->domicilio = $request['direccion'];
        $persona->telefono = $request['tel'];
        $persona->tipoDoc = $request['tipoDoc'];
        $persona->nroDocumento = $request['nroDocumento'];*/

        $persona->save();

        return back()->with('mensaje', 'Persona actualizada');
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
