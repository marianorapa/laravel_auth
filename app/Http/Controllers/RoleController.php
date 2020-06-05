<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permiso;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission');
    }
    /**
     * Display a listing of the resource.
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->get('name');
        $descr = $request->get('descr');

        $roles = Role::withTrashed()
                       ->name($name)
                       ->descr($descr)
                       ->get();
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
        $validatedData = $request->validate([
            'name' => 'required',
            'descr' => 'required|max:255'
        ]);

        $rol = new Role();
        $rol->fill($validatedData);

        // Checks if role already existed
        $rolExistente = Role::withTrashed()->where('name', $rol->name)->get()->first();

        // If it didn't, stores the new one
        if (is_null($rolExistente)) {
            $rol->save();
            if (isset($request['idPermisos'])){
                foreach($request['idPermisos'] as $idPermiso){
                    $permiso = Permiso::where('id', $idPermiso)->first();
                    $rol->permisos()->attach($permiso);
                }
            }
            return back()->with('mensaje', 'Rol creado.');

        }

        if ($rolExistente->trashed()){
            $rolExistente->restore();
            return back()->with('mensaje', 'El rol ya existía y ha sido activado nuevamente.');
        }

        return back()->with('error', 'Ya existe un rol activo con el nombre ingresado.');

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
        if ($id != 1){
            $rol = Role::withTrashed()->findOrFail($id);

            $permisos = Permiso::all();

            return view('admin.roles.edit', compact('rol','permisos'));
        }

        return back()->with('error', 'El rol administrador no puede modificarse.');
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
        if ($id != 1) {
            $rol = Role::withTrashed()->findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required',
                'descripcion' => 'required|max:255'
            ]);

            $rol->fill($validatedData);

            $rol->permisos()->detach();

            if (isset($request['permisos'])) {
                foreach ($request['permisos'] as $idPermiso) {
                    $permiso = Permiso::where('id', $idPermiso)->first();
                    $rol->permisos()->attach($permiso);
                }
            }
            /*$permisos = Permiso::all();

            foreach ($permisos as $permiso) {
                if (in_array($permiso->id, $request['permisos'])) {
                    $rol->permisos()->attach($permiso);
                }
            }*/
            try {
                $rol->save();
            } catch (QueryException $e) {
                return back()->with('error', 'Se produjo un error al guardar el rol.');
            }

            return back()->with('mensaje', 'Rol actualizado correctamente');
        }

        return back()->with('error', 'Rol de administrador no puede modificarse');
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

        $noDelete = DB::table("role_user")->where("role_id","=",$rol->id)
                        ->join("users","users.id","role_user.user_id")
                        ->where("users.deleted_at","=",null)->get(); //checkea que el rol no este asociado a un user activo.
        if ($noDelete->isNotEmpty()){
            return back()->with('error', 'El rol pertenece a un usuario.');
        }
        $rol->delete();
        return back()->with('mensaje', 'Rol desactivado correctamente.');
    }

    public function activate($id)
    {
        $rol = Role::withTrashed()->findOrFail($id);

        $rol->restore();

        return back()->with('mensaje', 'Se activó el rol nuevamente :)');
    }
}
