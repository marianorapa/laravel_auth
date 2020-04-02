<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
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
        $this->middleware('guest');
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
        // User::create([
        //     'username' => $data['username'],
        //     'password' => Hash::make($data['password']),
        //     'email' => $data['email'],
        //     'descr' => $data['descr'],
        //     'activo' => true            
        // ]);
        //User::->roles()->attach(Roles::all());

        $user = new User();
        $user->username = $data['username'];
        $user->password = Hash::make($data['password']);
        $user->email = $data['email'];
        $user->descr = $data['descr'];
        $user->activo = true;
        
        $user->save(); 
        
        $user->roles()->attach(Role::all());

    }

    // Codigo propio

    public function checkUserExistence(){

        if (User::get()->first()){
            return redirect(route('auth.login'));
        }
        
        return view('auth.register');

    }

    protected function RegisterUser(Request $request){        
        $this->create($request->all());

        return route('admin.index');
    }

}
