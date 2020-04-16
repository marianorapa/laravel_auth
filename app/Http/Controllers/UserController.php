<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\QueryException;
use App\User;
use App\Role;
use App\Persona;

class UserController extends Controller
{
    public function __construct()
    {
//        $this->middleware('App\Http\Middleware\IsAdmin');
        $this->middleware('permission');

    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name  = $request->get('name');
        $email = $request->get('email');

        //Adaptacion de los scope en las otras clases modelo.
        $users = User::withTrashed()
        ->where('username', 'LIKE',"%$name%")  
        ->where('email', 'LIKE',"%$email%")
        ->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $personas = Persona::all();

        return view('admin.users.create', compact('roles','personas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Copio y pego del register controller
        $user = new User();
        $user->username = $request['username'];
        $user->password = Hash::make($request['password']);
        $user->email = $request['email'];
        $user->descr = $request['descripcion'];
//        $user->activo = true;

        // Busco la persona que recibi
        $persona = Persona::find($request['persona']);
        $user->persona()->associate($persona);

        try {
            $user->save();
        }
        catch (QueryException $e)
        {
            return back()->with('error', 'El usuario o email ya existen.');
        }

        $roles = Role::all();

        // Ahora le pongo los que vienen en la solicitud
        foreach($roles as $rol){
            if ($request[$rol->name]){
                $user->roles()->attach($rol);
            }
            // else {
            //     $user->roles()->detach($rol);
            // }
        }
        try {
            $user->save();
        }
        catch (QueryException $e)
        {
            return back()->with('error', 'Error al asignar roles.');
        }

        return back()->with('mensaje', 'Usuario registrado');
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
    // EL PATH ES users/id/edit
    public function edit($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $roles = Role::all();

        $userRoles = $user->roles()->get();

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
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
        $user = User::withTrashed()->findOrFail($id);

        $this->validate($request, [
            'username' => 'required'
        ]);

        // Si viene una password, desea cambiarla. Si no viene, no la toco
        if ($request['password'] != null){
            $this->validate($request, [
                'password' => 'required|confirmed'
            ]);
            $user->password = Hash::make($request['password']); // La tengo que hashear
        }

        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->descr = $request['descripcion'];
//        $user->activo = true;


        $roles = Role::all();
        // Primero le saco todos los roles
        $user->roles()->detach();
        // Ahora, de todos los roles, le pongo solo los que vienen en la solicitud
        foreach($roles as $rol){
            if (in_array($rol->name, $request['roles'])){
                $user->roles()->attach($rol);
            }
            // Saco esto xq lo hago arriba y aca trae problemas
            // else {
            //     $user->roles()->detach($rol);
            // }
        }
        try {
            $user->save();
        }
        catch (Error $e)
        {
            return back()->with('error', 'Se produjo un error al actualizar el usuario');
        }
        return back()->with('mensaje', 'Usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::id() == $id)
        {
            // Si se intenta eliminar logueado, no lo dejo
            return Redirect::back()->withErrors(['No se puede desactivar este usuario', 'msg']);
        }
        else
        {
            $userEliminar = User::findOrFail($id);
            $userEliminar->delete();
//            $userEliminar->activo = false;
//            $userEliminar->save();
            return back()->with('mensaje', 'Se desactivó al usuario del sistema :)');
        }
    }

    public function activate($id)
    {
        $user = User::withTrashed()->findOrFail($id);

//        $user->activo = true;
//
//        $user->save();
        $user->restore();

        return back()->with('mensaje', 'Se activó al usuario nuevamente :)');
    }
}
