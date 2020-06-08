<?php

namespace App\Observers;

use App\EstadoOpOrdenProduccion;
use App\EstadoOrdenProduccion;
use App\OrdenProduccion;
use Illuminate\Support\Facades\Auth;

class OrdenProduccionObserver
{
    /**
     * Handle the orden produccion "created" event.
     *
     * @param  \App\OrdenProduccion  $ordenProduccion
     * @return void
     */
    public function created(OrdenProduccion $ordenProduccion)
    {
        // Se inserta en estado pendiente

        $estado = EstadoOrdenProduccion::getEstadoPendiente();

        $estadoOpOrden = new EstadoOpOrdenProduccion();
        $estadoOpOrden->user()->associate(Auth::user());     // Cambiado
        $estadoOpOrden->estado_id = $estado->id;
        $estadoOpOrden->ord_pro_id = $ordenProduccion->id;
        $estadoOpOrden->save();
    }

    /**
     * Handle the orden produccion "updated" event.
     *
     * @param  \App\OrdenProduccion  $ordenProduccion
     * @return void
     */
    public function updated(OrdenProduccion $ordenProduccion)
    {
        //
    }

    /**
     * Handle the orden produccion "deleted" event.
     *
     * @param  \App\OrdenProduccion  $ordenProduccion
     * @return void
     */
    public function deleted(OrdenProduccion $ordenProduccion)
    {
        //
    }

    /**
     * Handle the orden produccion "restored" event.
     *
     * @param  \App\OrdenProduccion  $ordenProduccion
     * @return void
     */
    public function restored(OrdenProduccion $ordenProduccion)
    {
        //
    }

    /**
     * Handle the orden produccion "force deleted" event.
     *
     * @param  \App\OrdenProduccion  $ordenProduccion
     * @return void
     */
    public function forceDeleted(OrdenProduccion $ordenProduccion)
    {
        //
    }
}
