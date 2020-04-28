<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BalanzaController extends Controller
{
    //

    public function index()
    {
        return view('balanzas.index');
    }
}
