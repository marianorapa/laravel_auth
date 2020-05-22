<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Insumo;
use App\InsumoNoTrazable;
use App\Proveedor;
use App\TicketEntrada;
use App\Transportista;
use App\Utils\EntradasInsumoManager;
use App\Utils\TicketsEntradaManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $patente = $request->get('patente');
        $cliente = $request->get('cliente');

        // Recuperar ultimos ingresos
        $ticketsEntrada = TicketEntrada::paginate(10);
// Lo de abajo funciona pero no se va a poder paginar hasta hacerlo manualmente
//        $ticketsEntradaNt =
//            DB::table('ticket_entrada')
//                ->join('ticket', 'ticket.id', '=','ticket_entrada.id')
//                ->join('empresa', 'empresa.id', '=', 'cliente_id')
//                ->join('ticket_entrada_insumo_no_trazable as nt', 'nt.id', '=','ticket.id')
//                ->join('insumo', 'insumo.id', '=', 'nt.insumo_nt_id')
//                ->join('pesaje as p1', 'p1.id', '=', 'ticket.bruto')
//                ->join('pesaje as p2', 'p2.id', '=', 'ticket.tara')
//                ->select('ticket.id', 'empresa.denominacion', 'ticket.created_at', 'insumo.descripcion',
//                    'p1.peso as bruto','p2.peso as tara', 'ticket.patente')
//                ->orderBy('ticket.created_at', 'desc')
////                ->paginate(10);
//                ->get();
//
//        $ticketsEntradaTra =
//            DB::table('ticket_entrada')
//                ->join('ticket', 'ticket.id', '=','ticket_entrada.id')
//                ->join('empresa', 'empresa.id', '=', 'cliente_id')
//                ->join('ticket_entrada_insumo_trazable as tra', 'tra.id', '=','ticket.id')
//                ->join('lote_insumo_especifico as li', 'li.id', '=', 'tra.insumo_t_id')
//                ->join('insumo_especifico as ie','ie.gtin','=','li.insumo_especifico')
//                ->join('insumo', 'insumo.id', '=', 'ie.insumo_trazable_id')
//                ->join('pesaje as p1', 'p1.id', '=', 'ticket.bruto')
//                ->join('pesaje as p2', 'p2.id', '=', 'ticket.tara')
//                ->select('ticket.id', 'empresa.denominacion', 'ticket.created_at', 'insumo.descripcion',
//                    'p1.peso as bruto','p2.peso as tara', 'ticket.patente')
//                ->orderBy('ticket.created_at', 'desc')
////                ->paginate(10);
//                ->get();
//
//        dd($ticketsEntradaNt->union($ticketsEntradaTra));

        return view('balanzas.ingresos.index', compact('ticketsEntrada'));
    }

    /**
     * Display formulario de registro inicial ingreso insumo
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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


    public function guardarEntradaInicial(Request $request){

        $validated = $request->validate([
            'cliente' => ['required', 'exists:cliente,id'],
            'insumo' => ['required'],
            'proveedor' => ['required', 'exists:proveedor,id'],
            'transportista' => ['required', 'exists:transportista,id'],
            'patente' => ['required'],
            'nro_cbte' => ['required'],
            'pesaje' => ['required', 'numeric']
        ]);

        /* Separo en atributos para independizar al manager de los nombres de los inputs en la vista*/
        $idCliente = $validated['cliente'];
        $idInsumo = $validated['insumo'];
        $idProveedor = $validated['proveedor'];
        $idTransportista = $validated['transportista'];
        $patente = $validated['patente'];
        $nroCbte = $validated['nro_cbte'];
        $pesaje = $validated['pesaje'];

        if (!$request->has('isInsumoTrazable')){
            EntradasInsumoManager::registrarEntradaInicialInsumoNoTrazable($idCliente, $idInsumo,
                $idProveedor, $idTransportista, $patente, $nroCbte, $pesaje);

            return redirect()->action('EntradaController@index')->with('message', 'Ingreso de insumo no trazable registrado con éxito!');
        }
        else {
            /* Si es un insumo trazable, hago validacion adicional */
            $validated = $request->validate([
                'nrolote' => ['required'],
                'fechaelaboracion' =>['required', 'date'],
                'fechavencimiento' =>['required', 'date']
            ]);

            $nroLote = $validated['nrolote'];
            $fechaElab = $validated['fechaelaboracion'];
            $fechaVenc = $validated['fechavencimiento'];

            EntradasInsumoManager::registrarEntradaInicialInsumoTrazable(
                $idCliente, $idInsumo, $nroLote, $fechaElab, $fechaVenc, $idProveedor, $idTransportista, $patente,
                $nroCbte, $pesaje);

            return redirect()->action('EntradaController@index')->with('message', 'Ingreso de insumo trazable registrado con éxito!');
        }
    }



    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registroInsumoFinal($id)
    {
        $ticketEntrada = TicketEntrada::findOrFail($id);

        /* Guardo en la sesión el id a finalizar */
        Session::put('id_ticket_a_finalizar', $id);

        /* Viewbag con datos para la vista. Complejo por las relaciones, pero ahorra muchos joins*/
        /* Debe ser mas eficiente con joins y select, esto seguro hace un query por cada relacion*/
        $viewbag = [
            'patente' => $ticketEntrada->ticket()->first()->patente,
            'cliente' => $ticketEntrada->ticket()->first()->cliente()->first()->empresa()->first()->denominacion,
            'insumo' => $ticketEntrada->ticketEntradaInsumoTrazable()->exists() ?
                $ticketEntrada->ticketEntradaInsumoTrazable()->first()
                    ->loteInsumoEspecifico()->first()
                    ->insumoEspecifico()->first()
                    ->insumoTrazable()->first()
                    ->insumo()->first()->descripcion :
                $ticketEntrada->ticketEntradaInsumoNoTrazable()->first()
                    ->insumoNoTrazable()->first()
                    ->insumo()->first()->descripcion,
            'proveedor' => $ticketEntrada->ticketEntradaInsumoTrazable()->exists() ?
                $ticketEntrada->ticketEntradaInsumoTrazable()->first()
                    ->loteInsumoEspecifico()->first()
                    ->insumoEspecifico()->first()
                    ->proveedor()->first()
                    ->empresa()->first()->denominacion :
                $ticketEntrada->ticketEntradaInsumoNoTrazable()->first()
                    ->proveedor()->first()
                    ->empresa()->first()->denominacion,
            'nrolote' => $ticketEntrada->ticketEntradaInsumoTrazable()->exists() ?
                $ticketEntrada->ticketEntradaInsumoTrazable()->first()
                    ->loteInsumoEspecifico()->first()->nro_lote : 'No aplica',
            'transportista' => $ticketEntrada->ticket()->first()->transportista()->first()->empresa()->first()->denominacion,
            'nroCbte' => $ticketEntrada->cbte_asociado,
            'bruto' => $ticketEntrada->ticket()->first()->bruto()->first()->peso
        ];

        return view('balanzas/ingresos/registroinsumofinal', compact('viewbag'));
    }


    public function finalizarEntradaInsumo(Request $request){

        $id = Session::get('id_ticket_a_finalizar');

        $validated = $request->validate([
            'tara' => ['required','numeric']
        ]);

        $tara = $validated['tara'];
        TicketsEntradaManager::finalizarTicket($id, $tara);

        return redirect()->action('EntradaController@index')->with('message', 'Ingreso finalizado con éxito!');
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInsumosTrazables(Request $request){
        $id = $request->get('id');
        $ins = Proveedor::findOrFail($id)->insumosEspecificos()->get();
        return response()->json($ins);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInsumos(){
        $insumos = Insumo::all();
        return response()->json($insumos);
    }

    // Habria que usar esta para que solo traiga los no trazables
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInsumosNoTrazables(){
        $insumosNoTrazables = InsumoNoTrazable::all();
        $arrayins = [];
        foreach ($insumosNoTrazables as $actual){
            $arrayins[$actual->id]= $actual->insumo->descripcion;
        }
        return response()->json($data = [$arrayins,count($arrayins)]);
    }



}
