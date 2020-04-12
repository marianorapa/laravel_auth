<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/main';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // SACO MIDDLEWARE 03-04 00:44 -> NO ME DEJA ENTRAR SI NO
        //$this->middleware('guest')->except('logout');
    }


    public function username()
    {
        return 'username';
    }


    public function login(){
        if (!User::get()->first()){
            return redirect(route('register'));
        }
        else if (Auth::user())
        {
            return redirect(route('main'));
        }

        return view('auth.login');
    }

    public function authenticate(Request $request)
    {

        $credentials = $this->validate(request(), [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        // Previo al chequeo de Auth (que seguro se mete con cookies),
        // reviso si el supuesto username esta activo.
        $username = $request['username'];

        // Obtengo ese usuario y que este activo
        $user = User::where('username', $username)->first();

        // Si es null -> no existe o no esta activo
        if ($user == null)
        {
            return back()->with('error', 'Usuario o password no corresponden a usuario activo.');
        }

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect(route('main'));
        }

        return back()->with('error', 'Usuario o password incorrectos');
    }

    public function logout(){
        Auth::logout();

        return view('welcome');
    }
}
