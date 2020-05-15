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
use App\Utils\EntradasInsumoManager;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
        $arrayInsumoespe= [];
        /*foreach ($insumos as $ins){
            //$arrayInsumoespe=$ins->insumoTrazable->insumoEspecificos()->all();
            foreach ($ins->insumoTrazable->insumoEspecificos as $insumoE){
                if ($insumoE->proveedor_id = $id){
                    $arrayInsumoespe[$insumoE->gtin] = $insumoE->descripcion;
                }
            }
        }*/
        //return response()->json(Proveedor::findOrFail($id)->insumosEspecificos()->all());

        return response()->json($insumos);

    }


}
