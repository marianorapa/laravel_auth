<?php

namespace App\Http\Controllers;

class BalanzaController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission');
    }

    public function index()
    {
        return view('balanzas.index');
    }
}
