<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permiso;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('App\Http\Middleware\IsAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $roles = Role::all();

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
        $rol->activo = true;

       /* $permisos = Permiso::all(); 
        foreach($permisos as $permiso){
            if ($request[$permiso->name]){
                $rol->permisos()->attach($permiso);                
            }
            else {
                $rol->roles()->detach($permiso);
            }
        }*/




        $rol->save();

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
        $rol = Role::find($id);

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
        $rol = Role::find($id);

        $permisos = Permisos::all();

        $rol->name = $request['name'];
        $rol->descr = $request['descr'];
        $rol->activo = true;

        foreach($permisos as $permiso){
            // Verifico que permisos estan en el request
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
    }
}
