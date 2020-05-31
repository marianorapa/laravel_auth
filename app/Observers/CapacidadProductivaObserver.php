<?php

namespace App\Observers;

use App\CapacidadProductiva;
use Illuminate\Support\Facades\DB;

class CapacidadProductivaObserver
{



    public function creating(CapacidadProductiva $capacidadProductiva)
    {
        if (is_null($capacidadProductiva->fecha_hasta)){
            /* Es una capacidad permanente */
        }
        else {
            /* Es una capacidad temporal */
            // Tengo que verificar que no haya otra superpuesta para esa fecha
            $existen = DB::table('capacidad_productiva')
                ->where([
                    ['fecha_desde','<=', $capacidadProductiva->fecha_desde],
                    ['fecha_hasta', '>=', $capacidadProductiva->fecha_desde]
                ])
                ->orWhere([
                    ['fecha_desde', '<=', $capacidadProductiva->fecha_hasta],
                    ['fecha_hasta', '>=', $capacidadProductiva->fecha_hasta],
                ])
                ->orWhere([
                    ['fecha_desde', '>=', $capacidadProductiva->fecha_desde],
                    ['fecha_hasta', '<=', $capacidadProductiva->fecha_hasta],
                ])
                ->where('prioridad_id', '=', 1)
                ->exists();
            if ($existen){
                return false;
            }
        }
    }


    /**
     * Handle the capacidad productiva "created" event.
     *
     * @param  \App\CapacidadProductiva  $capacidadProductiva
     * @return void
     */
    public function created(CapacidadProductiva $capacidadProductiva)
    {
//        Upd. queda siempre null la de las prioridades 2
//        if (is_null($capacidadProductiva->fecha_hasta)){
//            /* Es una capacidad permanente */
//            // Tengo que finalizar la anterior
//
//            $capacidadActual = CapacidadProductiva::all()
//                ->where('fecha_hasta', '=', null)->first();
//
//            $capacidadActual->fecha_hasta = date('Y-m-d ');
//            $capacidadActual->save();
//        }
//        else {
//            /* Es una capacidad temporal */
//        }
    }

    /**
     * Handle the capacidad productiva "updated" event.
     *
     * @param  \App\CapacidadProductiva  $capacidadProductiva
     * @return void
     */
    public function updated(CapacidadProductiva $capacidadProductiva)
    {
        //
    }

    /**
     * Handle the capacidad productiva "deleted" event.
     *
     * @param  \App\CapacidadProductiva  $capacidadProductiva
     * @return void
     */
    public function deleted(CapacidadProductiva $capacidadProductiva)
    {
        //
    }

    /**
     * Handle the capacidad productiva "restored" event.
     *
     * @param  \App\CapacidadProductiva  $capacidadProductiva
     * @return void
     */
    public function restored(CapacidadProductiva $capacidadProductiva)
    {
        //
    }

    /**
     * Handle the capacidad productiva "force deleted" event.
     *
     * @param  \App\CapacidadProductiva  $capacidadProductiva
     * @return void
     */
    public function forceDeleted(CapacidadProductiva $capacidadProductiva)
    {
        //
    }
}
