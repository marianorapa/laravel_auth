<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Insumo;
use App\Proveedor;
use App\TicketEntrada;
use App\Transportista;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Recuperar ultimos ingresos
        TicketEntrada::paginate(10);

        return view('balanzas.ingresos.index');
    }

    /**
     * Display formulario de registro inicial ingreso insumo
     *
     * @return \Illuminate\Http\Response
     */
    public function registroInsumoInicial()
    {
        // Obtener clientes
        $clientes = Cliente::all();
        // Obtener insumos
        $insumos = Insumo::all();
        // Obtener proveedores
        $proveedores = Proveedor::all();
        // Obtener transportistas
        $transportistas = Transportista::all();

        return view('balanzas/ingresos/registroinsumo',
            compact('clientes','insumos','proveedores', 'transportistas'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registroInsumoFinal()
    {
        return view('balanzas/ingresos/registroinsumofinal');
    }



    public function guardarEntradaInicial(Request $request){


        $validated = $request->validate([
            'cliente'=>['required', 'exists:cliente,id'],
            'insumo'=>['required', 'exists:insumo,id'],
            'proveedor'=>['required', 'exists:proveedor,id'],
            'nrolote'=>['required'],
            'transportista'=>['required', 'exists:transportista,id'],
            'patente'=>['required'],
            'nro_cbte'=>['required'],
        ]);


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
