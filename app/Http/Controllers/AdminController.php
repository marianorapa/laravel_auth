<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\IsAdmin');
    }


    public function index()
    {
        
    }
    


}
