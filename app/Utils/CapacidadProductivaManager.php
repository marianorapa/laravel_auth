<?php


namespace App\Utils;


use Illuminate\Support\Facades\DB;

class CapacidadProductivaManager
{


    public static function existeCapacidadProductiva($fechaEntrega, $cantidadFabricar)
    {
        $capacidad = self::getCapacidadRestante($fechaEntrega);

        return $cantidadFabricar <= $capacidad;
    }

    /**
     * @param $fechaEntrega
     * @return array
     */
    public static function getCapacidadRestante($fechaEntrega)
    {

        $capacidadFecha = DB::table('capacidad_productiva')
            ->where([
                ['fecha_hasta', '<>', 'null'],
                ['fecha_desde', '<=', $fechaEntrega],
                ['fecha_hasta', '>=', $fechaEntrega]
            ])
            ->orWhere([
                ['fecha_hasta', '=', null],
                ['fecha_desde', '<=', $fechaEntrega]
            ])
            ->orderBy('prioridad_id')->orderByDesc('id')->get()->first()->capacidad;


        $capacidadOcupada = DB::table('orden_de_produccion as op')
            ->where('op.fecha_fabricacion', '=', $fechaEntrega)
            ->where('op.anulada', '=', 0)
            ->sum('op.cantidad');


        return $capacidadFecha - $capacidadOcupada;
    }
}
