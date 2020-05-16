<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Insumo;
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
            'insumo' => ['required', 'exists:insumo,id'],
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

            return back()->with('message', 'Ingreso de insumo no trazable registrado con éxito!');
        }
        else {
            /* Si es un insumo trazable, hago validacion adicional */
            $validated = $request->validate([
                'nrolote' => ['required'],
                'fecha_elaboracion' =>['required', 'date'],
                'fecha_vencimiento' =>['required', 'date']
            ]);

            $nroLote = $validated['nrolote'];
            $fechaElab = $validated['fecha_elaboracion'];
            $fechaVenc = $validated['fecha_vencimiento'];

            EntradasInsumoManager::registrarEntradaInicialInsumoTrazable(
                $idCliente, $idInsumo, $nroLote, $fechaElab, $fechaVenc, $idProveedor, $idTransportista, $patente,
                $nroCbte, $pesaje);

            return back()->with('message', 'Ingreso de insumo trazable registrado con éxito!');
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

        $insumos = Insumo::all();
        /*$arrayInsumoespe= [];
        foreach ($insumos as $ins){
            //$arrayInsumoespe=$ins->insumoTrazable->insumoEspecificos()->all();
            foreach ($ins->insumoTrazable->insumoEspecificos as $insumoE){
                if ($insumoE->proveedor_id = $id){
                    $arrayInsumoespe[$insumoE->gtin] = $insumoE->descripcion;
                }
            }
        }*/
        $ins = Proveedor::findOrFail($id)->insumosEspecificos()->get();

        return response()->json($ins);
        //return response()->json($insumos);

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



}
