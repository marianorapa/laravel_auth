<?php

namespace App\Http\Controllers;

class AdministracionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('permission');
    }

    public function index(){
        return view('administracion.index');
    }

}
