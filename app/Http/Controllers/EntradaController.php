<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Insumo;
use App\InsumoEspecifico;
use App\InsumoTrazable;
use App\LoteInsumoEspecifico;
use App\Proveedor;
use App\Ticket;
use App\TicketEntrada;
use App\TicketEntradaInsumoTrazable;
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

        if (!$request->has('isInsumoTrazable')){
            $validated = $request->validate([
                'cliente'=>['required', 'exists:cliente,id'],
                'insumo'=>['required', 'exists:insumo,id'],
                'nrolote'=>['required'],
//                'fecha_elaboracion' =>['required', 'date'], pendiente
//                'fecha_vencimiento' =>['required', 'date'], pendiente
                'proveedor'=>['required', 'exists:proveedor,id'],
                'transportista'=>['required', 'exists:transportista,id'],
                'patente'=>['required'],
                'nro_cbte'=>['required'],
                'pesaje' => ['required', 'numeric']
            ]);

            $ticketEntradaTrazable = new TicketEntradaInsumoTrazable();

            $ticketEntrada = new TicketEntrada();

            $ticket = new Ticket();

            $ticket->cliente()->first()->associate(Cliente::findOrFail($validated['cliente']));
            $ticket->transportista()->first()->associate(Transportista::findOrFail($validated['transportista']));
            $ticket->patente = $validated['patente'];
            $ticket->bruto = $validated['pesaje'];

            $ticket->save();

            $ticketEntrada->ticket()->associate($ticket);
            $ticketEntrada->cbte_asociado = $validated['nro_cbte'];
            $ticketEntrada->save();

            $insumoTrazable = InsumoTrazable::findOrFail($validated['insumo']);

            $insumoEspecifico = $insumoTrazable->insumosEspecificos()->all()->where('id_proveedor', $validated['proveedor']);

            $loteInsumoEspecifico = $insumoEspecifico->lotesInsumoEspecifico()->all()->where('nro_lote', $validated['nrolote']);

            // Si no existe el lote aun en el sistema
            if (nullValue($loteInsumoEspecifico)) {
                $loteInsumoEspecifico = new LoteInsumoEspecifico();
                $loteInsumoEspecifico->insumoEspecifico()->associate($insumoEspecifico);
                $loteInsumoEspecifico->nro_lote = $validated['nrolote'];
//                $loteInsumoEspecifico->fecha_elaboracion = $validated['fecha_elaboracion']; pendiente
//                $loteInsumoEspecifico->fecha_vencimiento = $validated['fecha_vencimiento']; pendiente
                $loteInsumoEspecifico->save();
            }

            $ticketEntradaTrazable->loteInsumoEspecifico()->associate($loteInsumoEspecifico);

            $ticketEntradaTrazable->save();

        }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getInsumosTrazables(int $id){
        $insumos = Insumo::all();
        $arrayInsumoespe= [];
        foreach ($insumos as $ins){
            //$arrayInsumoespe=$ins->insumoTrazable->insumoEspecificos()->all();
            foreach ($ins->insumoTrazable->insumoEspecificos as $insumoE){
                if ($insumoE->proveedor_id = $id){
                    $arrayInsumoespe[$insumoE->gtin] = $insumoE->descripcion;
                }
            }
        }

        return $arrayInsumoespe;

    }
}
