<?php

namespace App\Observers;

use App\MovimientoProductoTicketSalida;
use App\OrdenProduccion;
use Illuminate\Support\Facades\DB;

class MovimientoProductoTicketSalidaObserver
{
    /**
     * Handle the movimiento producto tkt salida "created" event.
     *
     * @param  \App\MovimientoProductoTicketSalida  $MovimientoProductoTicketSalida
     * @return void
     */
    public function created(MovimientoProductoTicketSalida $movimientoProductoTicketSalida)
    {
        // Hay que actualizar el saldo en la orden de produccion
        $op_id = DB::table('ticket_salida as ts')->where('ts.id', '=', $movimientoProductoTicketSalida->tkt_sal_id)
            ->select('ts.op_id')->get()->first()->op_id;

        $op = OrdenProduccion::find($op_id);

        $cantidadMov = DB::table('movimiento_producto')->where('id', '=', $movimientoProductoTicketSalida->id)
            ->select('cantidad')->get()->first()->cantidad;

        // El saldo inicia igual a la cantidad fabricada. Por cada salida (mov. negativo) se resta
        // Si el mov. es negativo (una salida concretada) sumo tal cantidad negativa al saldo (o sea, resto)
        // Si se estuviera cancelando (un reintegro) el mov. es positivo por lo que se suma al saldo de la op
        $op->saldo += $cantidadMov;

        $op->save();
    }

    /**
     * Handle the movimiento producto tkt salida "updated" event.
     *
     * @param  \App\MovimientoProductoTicketSalida  $MovimientoProductoTicketSalida
     * @return void
     */
    public function updated(MovimientoProductoTicketSalida $MovimientoProductoTicketSalida)
    {
        //
    }

    /**
     * Handle the movimiento producto tkt salida "deleted" event.
     *
     * @param  \App\MovimientoProductoTicketSalida  $MovimientoProductoTicketSalida
     * @return void
     */
    public function deleted(MovimientoProductoTicketSalida $MovimientoProductoTicketSalida)
    {
        //
    }

    /**
     * Handle the movimiento producto tkt salida "restored" event.
     *
     * @param  \App\MovimientoProductoTicketSalida  $MovimientoProductoTicketSalida
     * @return void
     */
    public function restored(MovimientoProductoTicketSalida $MovimientoProductoTicketSalida)
    {
        //
    }

    /**
     * Handle the movimiento producto tkt salida "force deleted" event.
     *
     * @param  \App\MovimientoProductoTicketSalida  $MovimientoProductoTicketSalida
     * @return void
     */
    public function forceDeleted(MovimientoProductoTicketSalida $MovimientoProductoTicketSalida)
    {
        //
    }
}
