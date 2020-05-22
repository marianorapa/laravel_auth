<?php

namespace App\Observers;

use App\PrestamoDevolucion;

class DevolucionObserver
{
    /**
     * Handle the prestamo devolucion "created" event.
     *
     * @param  \App\PrestamoDevolucion  $prestamoDevolucion
     * @return void
     */
    public function created(PrestamoDevolucion $prestamoDevolucion)
    {
        // Al registrar una devolucion, actualiza el monto "cancelado" del prestamo cliente

    }

    /**
     * Handle the prestamo devolucion "updated" event.
     *
     * @param  \App\PrestamoDevolucion  $prestamoDevolucion
     * @return void
     */
    public function updated(PrestamoDevolucion $prestamoDevolucion)
    {
        //
    }

    /**
     * Handle the prestamo devolucion "deleted" event.
     *
     * @param  \App\PrestamoDevolucion  $prestamoDevolucion
     * @return void
     */
    public function deleted(PrestamoDevolucion $prestamoDevolucion)
    {
        //
    }

    /**
     * Handle the prestamo devolucion "restored" event.
     *
     * @param  \App\PrestamoDevolucion  $prestamoDevolucion
     * @return void
     */
    public function restored(PrestamoDevolucion $prestamoDevolucion)
    {
        //
    }

    /**
     * Handle the prestamo devolucion "force deleted" event.
     *
     * @param  \App\PrestamoDevolucion  $prestamoDevolucion
     * @return void
     */
    public function forceDeleted(PrestamoDevolucion $prestamoDevolucion)
    {
        //
    }
}
