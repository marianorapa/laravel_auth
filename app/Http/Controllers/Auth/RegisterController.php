<?php

namespace App\Http\Controllers\Auth;

use App\Domicilio;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PersonaController;
use App\Localidad;
use App\PersonaTipo;
use App\Providers\RouteServiceProvider;
use App\TipoDocumento;
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
    protected function create($validatedUsuario, $validatedPersonaTipo, $validatedPersona, $validatedDomicilio)
    {
        //$this->validator($data);

        $user = new User();
        $user->username = $validatedUsuario['username'];
        $user->password = Hash::make($validatedUsuario['password']);

        $localidad = Localidad::all()->where('descripcion',$validatedDomicilio['localidad'])->first();

        $domicilio = new Domicilio();
        $domicilio->fill($validatedDomicilio);
        $domicilio->localidad()->associate($localidad);
        $domicilio->save();

        $tipoDocumento = TipoDocumento::findOrFail($validatedPersonaTipo['id_tipo_documento']);

        $persona_tipo = new PersonaTipo();
        $persona_tipo->fill($validatedPersonaTipo);
        $persona_tipo->tipoDocumento()->associate($tipoDocumento);
        $persona_tipo->domicilio()->associate($domicilio);
        $persona_tipo->save();

        // Creo una persona con los datos ingresados
        $persona = new Persona();
        $persona->fill($validatedPersona);
        $persona->personaTipo()->associate($persona_tipo);
        $persona->save();

        $user->Persona()->associate($persona);
        $user->save();

        // Al unico que se registra le da rol de admin
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
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:6']
        ]);

        $validatedPersonaTipo = $request->validate([
            'id_tipo_documento' => ['required', 'exists:tipo_documento,id'],
            'nro_documento' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'telefono' => ['required'],
            'observaciones' => ['string']
        ]);

        $validatedPersona = $request->validate([
            'nombres' => ['required'],
            'apellidos' => ['required'],
            'fecha_nacimiento' => ['required','date','before:-20 years']
        ]);

        $validatedDomicilio = $request->validate([
            'calle' => ['required'],
            'numero' => ['required', 'numeric'],
            'piso' => ['numeric'],
            'dpto' => ['alpha_num'],
            //'codigo_postal' => ['required'],
            //'id_provincia' => ['required'], ya esta en localidad
            'localidad' => ['required','exists:localidad,descripcion']
        ]);

        $this->create($validatedUsuario, $validatedPersonaTipo, $validatedPersona, $validatedDomicilio);

        return redirect(route('main'));   // despues de entrar redirige al main
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getlocalidad(Request $request){
        $id = $request->get('provincia_id');

            $localidades = Localidad::where('provincia_id',"LIKE",$id)->get();
            foreach ($localidades as $localidad) {
                $localidadArray[$localidad->id] = $localidad->descripcion;
            }
            return response()->json($localidadArray);
    }

}
