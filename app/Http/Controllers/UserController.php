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
     * Reloads the form flashing data back
     */
    public function reloadCreate(Request $request)
    {
        $request->flash();
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // If user pressed "refresh" button
        if ($request->get('refreshButton')){
            $request->flash();
            return back()->with('mensaje', 'Personas actualizadas. ');
        }

        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'min:4|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:4',
            'descripcion' => 'required',
            'email' => 'required|email'
        ]);

        $user = new User();
        $user->fill(
            [
                'username' => $validatedData['username'],
                'password' => $validatedData['password'],
                'descr' => $validatedData['descripcion'],
                'email' => $validatedData['email']
            ]
        );
        /*$user->username = $request['username'];
        $user->password = Hash::make($request['password']);
        $user->email = $request['email'];
        $user->descr = $request['descripcion'];
        */
        $userExistente = User::withTrashed()->where('username', $user->username)->get()->first();

        if ($userExistente != null) {
            if ($userExistente->trashed()) {
                $userExistente->restore();
                return back()->with('mensaje', 'Usuario ya existía. Se ha reactivado con éxito.');
            }
            else {
                return back()->with('mensaje', 'Usuario ya existe.');
            }
        }

        // Si no existe el usuario

        // Busco la persona que recibi
        $persona = Persona::find($request['persona']);
        $user->persona()->associate($persona);

        try {
            $user->save();
        }
        catch (QueryException $e)
        {
            return back()->with('error', 'El email ya existe.');
        }


        if (Auth::user()->hasPermiso('users.roles.asignar')){

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

        return back()->with('mensaje', 'Usuario registrado')
            ->with('warning', 'No se han registrado los roles. Necesita permiso "Asignar roles a usuario"');
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
            'username' => 'required',
            'descripcion' => 'required',
            'email' => 'required|email'
        ]);

        // Si viene una password, desea cambiarla. Si no viene, no la toco
        if ($request['password'] != null){
            $this->validate($request, [
                'password' => 'required|confirmed',
                'password_confirmation'=>'required'
            ]);
            $user->password = Hash::make($request['password']); // La tengo que hashear
        }

        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->descr = $request['descripcion'];

        if (Auth::user()->hasPermiso('users.roles.asignar')){

            $roles = Role::all();

            // Antes de sacarle los roles, verifica si tiene el de admin y esta intentando sacarselo
            if ($user->hasRole('admin')){

                if (!isset($request['roles']) || !(in_array('admin', $request['roles']))){
                    return back()->with('error', 'No puede quitarse el rol de administrador');
                }
            }

            // Primero le saco todos los roles
            $user->roles()->detach();
            // Ahora, de todos los roles, le pongo solo los que vienen en la solicitud
            foreach($roles as $rol){
                if (isset($request['roles']) && in_array($rol->name, $request['roles'])){
                    $user->roles()->attach($rol);
                }
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
        return back()->with('mensaje', 'Usuario actualizado SIN MODIFICAR ROLES.
            No puede realizar esa acción. Necesita permiso "Asignar roles a usuario"');
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
