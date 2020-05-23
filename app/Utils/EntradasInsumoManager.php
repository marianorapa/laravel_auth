<?php


namespace App\Utils;


use App\InsumoNoTrazable;
use App\LoteInsumoEspecifico;
use App\Proveedor;
use App\TicketEntradaInsumoNoTrazable;
use App\TicketEntradaInsumoTrazable;
use Illuminate\Support\Facades\DB;

class EntradasInsumoManager
{

    public static function registrarEntradaInicialInsumoTrazable( $idCliente, $idInsumo,
            $nroLote, $fechaElab, $fechaVenc, $idProveedor,
            $idTransportista, $patente, $nroCbte, $pesaje) :TicketEntradaInsumoTrazable
    {

        $ticketEntrada = TicketsEntradaManager::registrarTicketEntrada($idCliente, $idTransportista, $patente,
            $nroCbte, $pesaje);



        $insumoEspecifico = DB::table('insumo_especifico')
            ->where('insumo_trazable_id', '=', $idInsumo)
            ->where('proveedor_id', '=', $idProveedor)
            ->get()
            ->first();



//        $insumoTrazable = InsumoTrazable::findOrFail($idInsumo);
//        $insumoEspecifico = $insumoTrazable->insumosEspecificos()->get()->where('id_proveedor', $idProveedor);
//
//        $loteInsumoEspecifico = $insumoEspecifico->lotesInsumoEspecifico()->all()->where('nro_lote', $nroLote);


        $loteInsumoEspecifico = DB::table('lote_insumo_especifico')
            ->where('insumo_especifico', '=', $insumoEspecifico->gtin)
            ->get()->first();



        // Si no existe el lote aun, lo guardo por primera vez
        if (is_null($loteInsumoEspecifico)) {
            $loteInsumoEspecifico = new LoteInsumoEspecifico();
            $loteInsumoEspecifico->insumo_especifico = $insumoEspecifico->gtin; //insumoEspecifico()->associate($insumoEspecifico);
            $loteInsumoEspecifico->nro_lote = $nroLote;
                $loteInsumoEspecifico->fecha_elaboracion = $fechaElab;
                $loteInsumoEspecifico->fecha_vencimiento = $fechaVenc;
            $loteInsumoEspecifico->save();
        }

        $ticketEntradaTrazable = new TicketEntradaInsumoTrazable();
        $ticketEntradaTrazable->ticketEntrada()->associate($ticketEntrada);
        $ticketEntradaTrazable->insumo_t_id = $loteInsumoEspecifico->id;
        $ticketEntradaTrazable->save();
        return $ticketEntradaTrazable;
    }

    public static function registrarEntradaInicialInsumoNoTrazable($idCliente, $idInsumo, $idProveedor,
        $idTransportista, $patente, $nroCbte, $pesaje) : TicketEntradaInsumoNoTrazable
    {
        $ticketEntrada = TicketsEntradaManager::registrarTicketEntrada($idCliente, $idTransportista, $patente,
            $nroCbte, $pesaje);

        $insumoNoTrazable = InsumoNoTrazable::findOrFail($idInsumo);

        $ticketEntradaNoTrazable = new TicketEntradaInsumoNoTrazable();
        $ticketEntradaNoTrazable->ticketEntrada()->associate($ticketEntrada);
        $ticketEntradaNoTrazable->insumoNoTrazable()->associate($insumoNoTrazable);
        $ticketEntradaNoTrazable->proveedor()->associate(Proveedor::findOrFail($idProveedor));
        $ticketEntradaNoTrazable->save();

        return $ticketEntradaNoTrazable;
    }


}
