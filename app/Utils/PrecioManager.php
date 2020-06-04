<?php


namespace App\Utils;


use Illuminate\Support\Facades\DB;

class PrecioManager
{


    public static function getPrecioReferencia()
    {
        return DB::table('precio_fason')
            ->where('fecha_desde', '>=', getdate())
            ->where('fecha_hasta', '<=', getdate())
            ->orWhere('fecha_hasta', '=', null)
            ->get()->first();
    }


    public static function isPrecioValido($precioXtn)
    {
        $precioRef = self::getPrecioReferencia();
        $precio = $precioRef->precio_por_tn;
        $variacion = $precioRef->variacion_admitida;
        $min = $precio - $variacion;
        $max = $precio + $variacion;

        return ($precioXtn >= $min && $precioXtn <= $max);
    }

}
