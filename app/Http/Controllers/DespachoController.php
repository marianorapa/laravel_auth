<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TicketSalida;
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
        $clientes = DB::table('cliente')
            ->join('empresa','cliente.id','=','empresa.id')
            ->select('cliente.id','empresa.denominacion')->get();
        return view('balanzas.despachos.pesajeInicialDespacho',compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente'=>['required','exists:cliente'],
            'op_id' => ['required','exists:orden_de_produccion,id'],
            'transportista' => ['required', 'exists:transportista,id'],
            'patente' => ['required'],
            'peso' => ['required', 'numeric']
        ]);


        $ticketSalida = new TicketSalida();
        $ticketSalida->op_id = $validated['op_id'];
        $ticket = new Ticket();

        $ticket->cliente_id = DB::table('orden_de_produccion')
                                ->where('orden_de_produccion.id', '=', $validated['op_id'])
                                ->join('alimento', 'alimento.id', '=','orden_de_produccion.producto_id')
                                ->select('alimento.cliente_id');

        if ($ticket->cliente_id != $validated['cliente']){
            return back()->with('error', 'Ciente seleccionado no coincide con el de la OP seleccionada');
        }

        $ticket->transportista_id = $validated['transportista'];
        $ticket->patente = $validated['patente'];
        $ticket->tara = $validated['peso'];
        $ticketSalida->ticket()->associate($ticket);
        $ticketSalida->save();
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

    /**
     * Retrieves the pending orders for the specified client in the request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getOP(Request $request)
    {
        $cliente_id = $request->get('id');
        $arrayOP = DB::table('orden_de_produccion')
            ->join('alimento', 'alimento.id','=','orden_de_produccion.producto_id')
            ->where('alimento.cliente_id','=',$cliente_id)
            ->select('orden_de_produccion.id','orden_de_produccion.fecha_fabricacion','orden_de_produccion.producto_id','orden_de_produccion.saldo')
            ->get();

        return response()->json($arrayOP);
    }
}
