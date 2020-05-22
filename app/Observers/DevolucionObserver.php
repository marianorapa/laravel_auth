<?php

namespace App\Observers;

use App\PrestamoCliente;
use App\PrestamoDevolucion;
use App\Utils\StockManager;

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
        $prestamoCliente = PrestamoCliente::find($prestamoDevolucion->prestamo_id);
        $prestamoCliente->cancelado += $prestamoDevolucion->cantidad;
        $prestamoCliente->save();

        // Actualizar stock fabrica insertando movimientos (delega en stock manager)
        StockManager::registrarDevolucionFabrica($prestamoDevolucion);

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
