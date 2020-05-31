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
            ->orderBy('prioridad_id')->orderByDesc('fecha_desde')->get()->first()->capacidad;


        $capacidadOcupada = DB::table('orden_de_produccion')
            ->where('fecha_fabricacion', '=', $fechaEntrega)
            ->sum('cantidad');

        return $capacidadFecha - $capacidadOcupada;
    }
}
