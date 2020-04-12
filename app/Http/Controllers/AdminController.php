<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Role;
use App\Permiso;

class AdminController extends Controller
{
    public function __construct()
    {
//        $this->middleware('App\Http\Middleware\IsAdmin');
        $this->middleware('permission');
    }


    public function index()
    {
        return view('admin.index');
    }

    public function users()
    {

    }

    public function permisos()
    {

    }

    public function roles()
    {

    }

    public function personas()
    {

    }

}
