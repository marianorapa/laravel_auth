<?php

namespace App\Http\Controllers\Auth;

use App\Domicilio;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PersonaController;
use App\Localidad;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Role;
use App\Persona;
use App\Utils\DomicilioManager;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
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
        $validatedUsuario = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed']
        ]);

        $validatedPersona = $request->validate([
            'nombresPersona' => ['required'],
            'apellidos' => ['required'],
            'fechaNac' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'tel' => ['required'],
            'tipoDoc' => ['required'],
            'nroDocumento' => ['required'],
            'observaciones' => ['string'],
        ]);

        $this->saveDomicilio($request);



        $this->create($validated);

        return redirect(route('main'));   // despues de entrar redirige al main
    }

<<<<<<< HEAD
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|int
     */
    protected function saveDomicilio(Request $request)
    {
        $validatedDomicilio = $request->validate([
            'calle' => ['required'],
            'numero' => ['required', 'numeric'],
            'piso' => ['numeric'],
            'codigo_postal' => ['required'],
            //'id_provincia' => ['required'], ya esta en localidad
            'id_localidad' => ['required']
        ]);

        try {
            $localidad = Localidad::findOrFail($validatedDomicilio['id_localidad']);

            $domicilio = new Domicilio();
            $domicilio->fill($validatedDomicilio);
            $domicilio->localidad($localidad);

            $domicilio->save();
            return $domicilio->id;
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Localidad no encontrada.');
        } catch (QueryException $e) {
            return back()->with('error', 'Error al guardar el domicilio.');
        }
    }

=======

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getlocalidad(Request $request){

        if ($request->ajax()) {
            $localidades = Localidad::where('provincia_id', $request->provincia_id)->get();
            foreach ($localidades as $localidad) {
                $localidadArray[$localidad->id] = $localidad->descripcion;
            }
            return response()->json($localidadArray);
        }
    }
>>>>>>> 5b03ea6bfe3304d6a9990b55092e53fc98b06a3a
}
