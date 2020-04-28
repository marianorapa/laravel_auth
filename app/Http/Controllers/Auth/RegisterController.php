<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Role;
use App\Persona;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest'); 03-4 00:50 <- Saco xq no me deja registrar si no
        $this->middleware('App\Http\Middleware\CheckUserExistence');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'descr' => ['required', 'string']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $this->validator($data);

        $user = new User();
        $user->username = $data['username'];
        $user->password = Hash::make($data['password']);
        $user->email = $data['email'];
        $user->descr = $data['descr'];
//        $user->activo = true;

        // Creo una persona con los datos ingresados
        $persona = new Persona();
        $persona->nombres = $data['nombresPersona'];
        $persona->apellidos = $data['apellidos'];
        $persona->descripcion = $data['descr'];
        $persona->fechaNacimiento = $data['fechaNac'];
        $persona->domicilio = $data['direccion'];
        $persona->telefono = $data['tel'];
        $persona->tipoDoc = $data['tipoDoc'];
        $persona->nroDocumento = $data['nroDocumento'];
        //$persona->activo = true;

        $persona->save();

        $user->persona()->associate($persona);

        $user->save();

        // Al unico que se registra le da todos los permisos! -> Dsp cambiar y elegir roles quizas...
        $user->roles()->attach(Role::where('name','admin')->first());

        Auth::login($user);
    }

    /**
     * Entrega el formulario para registrarse
     */
    public function getRegisterUser()
    {
        return view('auth.register');
    }

    protected function RegisterUser(Request $request){
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'descr' => ['required', 'string'],
            'nombresPersona' => ['required'],
            'apellidos' => ['required'],
            'fechaNac' => ['required'],
            'direccion' => ['required'],
            'tel' => ['required'],
            'tipoDoc' => ['required'],
            'nroDocumento' => ['required'],
        ]);

        $this->create($validated);

        return redirect(route('main'));   // despues de entrar redirige al main
    }

}
