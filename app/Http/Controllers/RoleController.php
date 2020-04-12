<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permiso;
use Illuminate\Database\QueryException;


class RoleController extends Controller
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
//        $roles = Role::all();
        $roles = Role::withTrashed()->get();
        return view ('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $permisos = Permiso::all();
        return view ('admin.roles.create',compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rol = new Role;

        $rol->name = $request['name'];
        $rol->descr = $request['descr'];
//        $rol->activo = true;

        foreach($request['permiso'] as $permiso){
            $permiso = Permiso::where('name',$permiso)->first();
            $rol->permisos()->attach($permiso);
        }

        try
        {
            $rol->save();
        }
        catch (QueryException $e)
        {
            return back()->with('error', 'El rol ya existe.');
        }
        return back()->with('mensaje', 'Rol registrado');
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
        $rol = Role::withTrashed()->findOrFail($id);

        $permisos = Permiso::all();

        return view('admin.roles.edit', compact('rol','permisos'));
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
        $rol = Role::withTrashed()->findOrFail($id);

        // $permisos = Permisos::all();

        $rol->name = $request['name'];
        $rol->descr = $request['descripcion'];
//        $rol->activo = true;

        $permisos = Permiso::all();

        $rol->permisos()->detach();

        foreach($permisos as $permiso){
            if (in_array($permiso->id, $request['permisos'])){
                $rol->permisos()->attach($permiso);
            }
        }

        try
        {
            $rol->save();
        }
        catch (QueryException $e)
        {
            return back()->with('error', 'El rol ya existe.');
        }

        return back()->with('mensaje', 'Rol actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Role::findOrFail($id);

        if (strtolower($rol->name) == 'admin'){
            return back()->with('error', 'El rol de administrador no puede eliminarse.');
        };

//        $rol->activo = false;
//        $rol->save();
        $rol->delete();
        return back()->with('mensaje', 'Rol desactivado correctamente.');
    }

    public function activate($id)
    {
        $rol = Role::withTrashed()->findOrFail($id);

//        $rol->activo = true;
//
//        $rol->save();

        $rol->restore();

        return back()->with('mensaje', 'Se activó el rol nuevamente :)');
    }
}
