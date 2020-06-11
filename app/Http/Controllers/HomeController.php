<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //this->middleware('permission');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasPermiso('admin.menu'))
        {
            return redirect(route('admin.menu'));
        }

        if (Auth::user()->hasPermiso('gerencia.index')){
            return redirect(route('gerencia.index'));
        }

        if (Auth::user()->hasPermiso('balanzas.menu')){
            return redirect(route('balanzas.menu'));
        }

        if (Auth::user()->hasPermiso('administracion.menu')){
            return redirect(route('administracion.menu'));
        }
    }
}
