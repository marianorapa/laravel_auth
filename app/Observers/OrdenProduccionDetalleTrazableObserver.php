<?php

namespace App\Observers;

use App\OrdenProduccionDetalleTrazable;
use App\Utils\StockManager;
use Illuminate\Support\Facades\DB;

class OrdenProduccionDetalleTrazableObserver
{
    /**
     * Handle the orden produccion detalle trazable "created" event.
     *
     * @param  \App\OrdenProduccionDetalleTrazable  $ordenProduccionDetalleTrazable
     * @return void
     */
    public function created(OrdenProduccionDetalleTrazable $ordenProduccionDetalleTrazable)
    {
        $opDetalleId = $ordenProduccionDetalleTrazable->op_detalle_id;
        $idLoteInsumo = $ordenProduccionDetalleTrazable->lote_insumo_id;

        $data = DB::table('orden_de_produccion_detalle as opd')
            ->where('opd.id', '=', $opDetalleId)
            ->join('orden_de_produccion as op', 'op.id', 'opd.op_id')
            ->join('alimento as a', 'a.id', 'op.producto_id')
            ->select('a.cliente_id', 'opd.cantidad')
            ->get()->first();


        $idCliente = $data->cliente_id;
        $cantidad = $data->cantidad;


        StockManager::registrarConsumoOpTrazable($opDetalleId, $idLoteInsumo, $idCliente, $cantidad);
    }

    /**
     * Handle the orden produccion detalle trazable "updated" event.
     *
     * @param  \App\OrdenProduccionDetalleTrazable  $ordenProduccionDetalleTrazable
     * @return void
     */
    public function updated(OrdenProduccionDetalleTrazable $ordenProduccionDetalleTrazable)
    {
        //
    }

    /**
     * Handle the orden produccion detalle trazable "deleted" event.
     *
     * @param  \App\OrdenProduccionDetalleTrazable  $ordenProduccionDetalleTrazable
     * @return void
     */
    public function deleted(OrdenProduccionDetalleTrazable $ordenProduccionDetalleTrazable)
    {
        //
    }

    /**
     * Handle the orden produccion detalle trazable "restored" event.
     *
     * @param  \App\OrdenProduccionDetalleTrazable  $ordenProduccionDetalleTrazable
     * @return void
     */
    public function restored(OrdenProduccionDetalleTrazable $ordenProduccionDetalleTrazable)
    {
        //
    }

    /**
     * Handle the orden produccion detalle trazable "force deleted" event.
     *
     * @param  \App\OrdenProduccionDetalleTrazable  $ordenProduccionDetalleTrazable
     * @return void
     */
    public function forceDeleted(OrdenProduccionDetalleTrazable $ordenProduccionDetalleTrazable)
    {
        //
    }
}
