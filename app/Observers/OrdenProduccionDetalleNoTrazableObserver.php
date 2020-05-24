<?php

namespace App\Observers;

use App\OrdenProduccionDetalleNoTrazable;
use App\Utils\StockManager;
use Illuminate\Support\Facades\DB;

class OrdenProduccionDetalleNoTrazableObserver
{
    /**
     * Handle the orden produccion detalle no trazable "created" event.
     *
     * @param  \App\OrdenProduccionDetalleNoTrazable  $ordenProduccionDetalleNoTrazable
     * @return void
     */
    public function created(OrdenProduccionDetalleNoTrazable $ordenProduccionDetalleNoTrazable)
    {
        //
        $opDetalleId = $ordenProduccionDetalleNoTrazable->op_detalle_id;
        $idInsumo = $ordenProduccionDetalleNoTrazable->insumo_id;

        $data = DB::table('orden_de_produccion_detalle as opd')
            ->where('opd.id', '=', $opDetalleId)
            ->select('opd.cantidad')
            ->get()->first();

        $idCliente = $ordenProduccionDetalleNoTrazable->cliente_id;
        $cantidad = $data->cantidad;

        StockManager::registrarConsumoOpNoTrazable($opDetalleId, $idInsumo, $idCliente, $cantidad);
    }

    /**
     * Handle the orden produccion detalle no trazable "updated" event.
     *
     * @param  \App\OrdenProduccionDetalleNoTrazable  $ordenProduccionDetalleNoTrazable
     * @return void
     */
    public function updated(OrdenProduccionDetalleNoTrazable $ordenProduccionDetalleNoTrazable)
    {
        //
    }

    /**
     * Handle the orden produccion detalle no trazable "deleted" event.
     *
     * @param  \App\OrdenProduccionDetalleNoTrazable  $ordenProduccionDetalleNoTrazable
     * @return void
     */
    public function deleted(OrdenProduccionDetalleNoTrazable $ordenProduccionDetalleNoTrazable)
    {
        //
    }

    /**
     * Handle the orden produccion detalle no trazable "restored" event.
     *
     * @param  \App\OrdenProduccionDetalleNoTrazable  $ordenProduccionDetalleNoTrazable
     * @return void
     */
    public function restored(OrdenProduccionDetalleNoTrazable $ordenProduccionDetalleNoTrazable)
    {
        //
    }

    /**
     * Handle the orden produccion detalle no trazable "force deleted" event.
     *
     * @param  \App\OrdenProduccionDetalleNoTrazable  $ordenProduccionDetalleNoTrazable
     * @return void
     */
    public function forceDeleted(OrdenProduccionDetalleNoTrazable $ordenProduccionDetalleNoTrazable)
    {
        //
    }
}
