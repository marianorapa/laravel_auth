<?php

namespace App\Observers;

use App\EstadoOpOrdenProduccion;
use App\EstadoOrdenProduccion;
use App\Utils\StockManager;
use Illuminate\Support\Facades\DB;

class EstadoOpOrdenProduccionObserver
{
    /**
     * Handle the estado op orden produccion "created" event.
     *
     * @param  \App\EstadoOpOrdenProduccion  $estadoOpOrdenProduccion
     * @return void
     */
    public function created(EstadoOpOrdenProduccion $estadoOpOrdenProduccion)
    {
        // Si contiene un estado finalizado o anulado, hay modificaciones de stock
        $opId = $estadoOpOrdenProduccion->ord_pro_id;
        $op = DB::table('orden_de_produccion')->find($opId);

        $idProducto = $op->producto_id;
        $cantidad = $op->cantidad;

        if ($estadoOpOrdenProduccion->estado_id == EstadoOrdenProduccion::getEstadoFinalizada()->id) {
            /* Si se esta finalizando, aumenta el stock de producto fabricado */
            StockManager::registrarFinalizacionOp($idProducto, $cantidad, $op);
        }
        else
            if ($estadoOpOrdenProduccion->estado_id == EstadoOrdenProduccion::getEstadoAnulada()->id) {
                /* Si se esta anulando, aumenta el stock de los insumos involucrados */

                StockManager::registrarAnulacionOp($op);
        }
    }

    /**
     * Handle the estado op orden produccion "updated" event.
     *
     * @param  \App\EstadoOpOrdenProduccion  $estadoOpOrdenProduccion
     * @return void
     */
    public function updated(EstadoOpOrdenProduccion $estadoOpOrdenProduccion)
    {
        //
    }

    /**
     * Handle the estado op orden produccion "deleted" event.
     *
     * @param  \App\EstadoOpOrdenProduccion  $estadoOpOrdenProduccion
     * @return void
     */
    public function deleted(EstadoOpOrdenProduccion $estadoOpOrdenProduccion)
    {
        //
    }

    /**
     * Handle the estado op orden produccion "restored" event.
     *
     * @param  \App\EstadoOpOrdenProduccion  $estadoOpOrdenProduccion
     * @return void
     */
    public function restored(EstadoOpOrdenProduccion $estadoOpOrdenProduccion)
    {
        //
    }

    /**
     * Handle the estado op orden produccion "force deleted" event.
     *
     * @param  \App\EstadoOpOrdenProduccion  $estadoOpOrdenProduccion
     * @return void
     */
    public function forceDeleted(EstadoOpOrdenProduccion $estadoOpOrdenProduccion)
    {
        //
    }
}
