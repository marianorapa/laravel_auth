<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        // SACO MIDDLEWARE 03-04 XQ NO ME DEJA ENTRAR SI NO
        //$this->middleware('guest')->except('logout');
    }


    public function username()
    {
        return 'username';
    }


    public function login(){        
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        
        $credentials = $this->validate(request(), [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);        

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect(route('main'));          
        }

        return back()->withError('mensaje', 'Usuario o password incorrectos');
    }

    public function logout(){
        Auth::logout();

        return view('welcome');
    }
}
