<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Persona;

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
     */
    public function index()
    {
//        $personas = Persona::all();
        $personas = Persona::withTrashed()->get();
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
        $persona = new Persona();
        $persona->nombres = $request['nombresPersona'];
        $persona->apellidos = $request['apellidos'];
        $persona->descripcion = $request['descr'];
        $persona->fechaNacimiento = $request['fechaNac'];
        $persona->domicilio = $request['direccion'];
        $persona->telefono = $request['tel'];
        $persona->tipoDoc = $request['tipoDoc'];
        $persona->nroDocumento = $request['nroDocumento'];
//        $persona->activo = true;

        try
        {
            $persona->save();
        }
        catch (QueryException $e){
            return back()->with('error', 'No puede registrarse el usuario. Nro. doc debe ser único.');
        }
        return back()->with('mensaje', 'Persona registrada');

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

        $persona->nombres = $request['nombresPersona'];
        $persona->apellidos = $request['apellidos'];
        $persona->descripcion = $request['descr'];
        $persona->fechaNacimiento = $request['fechaNac'];
        $persona->domicilio = $request['direccion'];
        $persona->telefono = $request['tel'];
        $persona->tipoDoc = $request['tipoDoc'];
        $persona->nroDocumento = $request['nroDocumento'];
//        $persona->activo = true;

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
        //
        $personaEliminar = Persona::findOrFail($id);
        $personaEliminar->delete();
//        $personaEliminar->activo = false;
//        $personaEliminar->save();
        return back()->with('mensaje','Se desactivó a la persona del sistema');
    }


    public function activate($id)
    {
        $persona = Persona::withTrashed()->findOrFail($id);
        $persona->restore();

//        $persona->activo = true;

//        $persona->save();

        return back()->with('mensaje', 'Se activó a la persona nuevamente');
    }
}
