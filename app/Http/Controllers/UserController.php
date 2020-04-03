<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Role;
use App\Persona;

class UserController extends Controller
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
        //
        $users = User::all();
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $user->activo = true;
        
        // Busco la persona que recibi
        $persona = Persona::find($request['persona']);
        $user->persona()->associate($persona);

        $user->save(); 
                
        $roles = Role::all();

        foreach($roles as $rol){
            if ($request[$rol->name]){
                $user->roles()->attach($rol);                
            }
            else {
                $user->roles()->detach($rol);
            }
        }

        $user->save();

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
        $user = User::findOrFail($id);

        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
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
        $user = User::findOrFail($id);

        $this->validate($request, [
            'username' => 'required'
        ]);
        

        if ($request['password'] != null){
            $this->validate($request, [
                'password' => 'required|confirmed'
            ]);
            $user->password = Hash::make($request['password']);
        }

        $user->username = $request['username'];        
        $user->email = $request['email'];
        $user->descr = $request['descripcion'];
        $user->activo = true;
        
        $roles = Role::all();


// DEBERIA BORRARLE LOS ROLES Y PONERLE LOS NUEVOS

        foreach($roles as $rol){
            if ($request[$rol->name]){
                $user->roles()->attach($rol);                
            }
        }
        
        $user->save();

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
        else {
            $userEliminar = User::findOrFail($id);
            //$userEliminar->delete();
            $userEliminar->activo = false;
            $userEliminar->save();
            return back()->with('mensaje', 'Se desactivó al usuario del sistema :)');
        }
    }


    public function activate($id)
    {
        $user = User::findOrFail($id);

        $user->activo = true;

        $user->save();

        return back()->with('mensaje', 'Se activó al usuario nuevamente :)');
    }
}
