<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DespachoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $cliente = $request->get('cliente');
        $patente = $request->get('patente');

        $despachos = DB::table('ticket_salida')
            ->join('ticket','ticket_salida.id','=','ticket.id')
            ->where('ticket.patente', 'like', "%$patente%")
            ->join('empresa', 'empresa.id','=','ticket.cliente_id')
            ->where('empresa.denominacion', 'like', "%$cliente%")
            ->join('orden_de_produccion', 'orden_de_produccion.id','=','ticket_salida.op_id')
            ->join('alimento','alimento.id','=','orden_de_produccion.producto_id')
            ->select('ticket_salida.id','empresa.denominacion', 'ticket.created_at', 'alimento.descripcion',
                       'orden_de_produccion.cantidad', 'ticket.patente')
            ->paginate(10);

        return View('balanzas.despachos.index', compact('despachos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('balanzas.despachos.pesajeInicialDespacho');
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


    public function finalize($id){
        $ticketSalida = DB::table('ticket_salida')
            ->where('ticket_salida.id', '=', $id)
            ->join('ticket','ticket.id','=','ticket_salida.id')
            ->join('empresa as e','e.id','=','ticket.cliente_id')
            ->join('orden_de_produccion', 'orden_de_produccion.id','=','ticket_salida.op_id')
            ->join('alimento', 'alimento.id','=','orden_de_produccion.producto_id')
            ->join('empresa as p','p.id','=','ticket.transportista_id')
            ->select('ticket_salida.id','ticket.patente','e.denominacion', 'p.denominacion',
                        'ticket.tara')
            ->get();

        dd($ticketSalida);
        return view('balanzas.despachos.pesajeFinalDespacho', compact('ticketSalida'));
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
