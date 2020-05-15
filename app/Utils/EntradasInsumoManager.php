<?php


namespace App\Utils;


use App\Cliente;
use App\InsumoNoTrazable;
use App\InsumoTrazable;
use App\LoteInsumoEspecifico;
use App\Proveedor;
use App\Ticket;
use App\TicketEntrada;
use App\TicketEntradaInsumoNoTrazable;
use App\TicketEntradaInsumoTrazable;
use App\Transportista;

class EntradasInsumoManager
{

    public static function registrarEntradaInicialInsumoTrazable( $idCliente, $idInsumo,
            $nroLote, $fechaElab, $fechaVenc, $idProveedor,
            $idTransportista, $patente, $nroCbte, $pesaje) :TicketEntradaInsumoTrazable
    {
        $ticketEntrada = TicketsEntradaManager::registrarTicketEntrada($idCliente, $idTransportista, $patente,
            $nroCbte, $pesaje);
        $insumoTrazable = InsumoTrazable::findOrFail($idInsumo);
        $insumoEspecifico = $insumoTrazable->insumosEspecificos()->all()->where('id_proveedor', $idProveedor);
        $loteInsumoEspecifico = $insumoEspecifico->lotesInsumoEspecifico()->all()->where('nro_lote', $nroLote);

        // Si no existe el lote aun, lo guardo por primera vez
        if (nullValue($loteInsumoEspecifico)) {
            $loteInsumoEspecifico = new LoteInsumoEspecifico();
            $loteInsumoEspecifico->insumoEspecifico()->associate($insumoEspecifico);
            $loteInsumoEspecifico->nro_lote = $nroLote;
//                $loteInsumoEspecifico->fecha_elaboracion = $validated['fecha_elaboracion']; pendiente
//                $loteInsumoEspecifico->fecha_vencimiento = $validated['fecha_vencimiento']; pendiente
            $loteInsumoEspecifico->save();
        }

        $ticketEntradaTrazable = new TicketEntradaInsumoTrazable();
        $ticketEntradaTrazable->ticketEntrada()->associate($ticketEntrada);
        $ticketEntradaTrazable->loteInsumoEspecifico()->associate($loteInsumoEspecifico);
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
