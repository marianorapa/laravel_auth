<?php

namespace App\Http\Controllers;

use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use App\Permiso;

class PermisoController extends Controller
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
//        $permisos = Permiso::all();
        $permisos = Permiso::withTrashed()->get();
        return view('admin.permisos.index', compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permisos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permisoNuevo = new Permiso;
        $permisoNuevo->nombre_ruta = $request['name'];
        $permisoNuevo->descr = $request['descr'];
        $permisoNuevo->funcionalidad = $request['funcionalidad'];
//        $permiso->activo = true;

        // Busco un permiso con el mismo nombre
        $permisoExistente = Permiso::withTrashed()->where('name', $permisoNuevo->nombre_ruta)->get()->first();

        // Si no existe, guardo el nuevo
        if ($permisoExistente == null) {
            $permisoNuevo->save();
            return back()->with('mensaje', 'Permiso creado');
        }

        if ($permisoExistente->trashed()){
            $permisoExistente->restore();
            return back()->with('mensaje', 'El permiso ya existía y ha sido activado nuevamente.');
        }

        return back()->with('mensaje', 'Ya existe un permiso activo con el nombre ingresado.');
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
        $permiso = Permiso::withTrashed()->findOrFail($id);

        return view('admin.permisos.edit', compact('permiso'));
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
        $permiso = Permiso::withTrashed()->findOrFail($id);

        $permiso->nombre_ruta = $request['name'];
        $permiso->descr = $request['descr'];
        $permiso->funcionalidad = $request['funcionalidad'];
//        $permiso->activo = true;

        $permiso->save();

        return back()->with('mensaje', 'Permiso actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permisoEliminar = Permiso::findOrFail($id);
        $permisoEliminar->delete();
//        $permisoEliminar->activo = false;
//        $permisoEliminar->save();

        return back()->with('mensaje','se elimino el permiso del sistema :)');
    }

    public function activate($id)
    {
        $permiso = Permiso::withTrashed()->findOrFail($id);

//        $permiso->activo = true;
//
//        $permiso->save();
        $permiso->restore();

        return back()->with('mensaje', 'Se activó el permiso nuevamente :)');
    }
}
