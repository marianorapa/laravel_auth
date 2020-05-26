<?php

namespace App\Http\Controllers;

use App\Pesaje;
use App\Ticket;
use App\TicketSalida;
use App\Utils\TicketsSalidaManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
            'cliente'=>['required','exists:cliente,id'],
            'op_id' => ['required','exists:orden_de_produccion,id'],
            'transportista' => ['required', 'exists:transportista,id'],
            'patente' => ['required'],
            'peso' => ['required', 'numeric']
        ]);

        $ticket = new Ticket();

        $ticket->cliente_id = DB::table('orden_de_produccion')
                                ->where('orden_de_produccion.id', '=', $validated['op_id'])
                                ->join('alimento', 'alimento.id', '=','orden_de_produccion.producto_id')
                                ->select('alimento.cliente_id')->get()->first()->cliente_id;

        if ($ticket->cliente_id != $validated['cliente']){
            return back()->with('error', 'Ciente seleccionado no coincide con el de la OP seleccionada');
        }

        $ticket->transportista_id = $validated['transportista'];
        $ticket->patente = $validated['patente'];

        $pesaje = new Pesaje();
        $pesaje->peso = $validated['peso'];
        $pesaje->save();
        $ticket->tara = $pesaje->id;

        $ticket->save();

        $ticketSalida = new TicketSalida();
        $ticketSalida->op_id = $validated['op_id'];
//        $ticketSalida->ticket()->associate($ticket);

        $ticketSalida->id = $ticket->id;

        $ticketSalida->save();
    }


    public function finalizeView($id){
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

        /* Guardo en la sesión el id a finalizar */
        Session::put('id_ticket_salida', $id);

        return view('balanzas.despachos.pesajeFinalDespacho', compact('ticketSalida'));
    }


    public function finalize(Request $request, $id){
//        $id = Session::get('id_ticket_salida');

        $validated = $request->validate([
            'bruto' => ['required','numeric']
        ]);

        $bruto = $validated['bruto'];

        $pesaje = new Pesaje();
        $pesaje->peso = $bruto;
        $pesaje->save();

        TicketsSalidaManager::finalizarTicket($id, $pesaje);

        return redirect()->action('DespachoController@index')->with('message', 'Despacho finalizado con éxito.');
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
