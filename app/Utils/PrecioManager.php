<?php


namespace App\Utils;


use Illuminate\Support\Facades\DB;

class PrecioManager
{


    public static function getPrecioReferencia()
    {
        return DB::select(DB::raw("SELECT * FROM precio_fason
                        WHERE (fecha_desde <= CURDATE() AND fecha_hasta >= CURDATE())
                        OR (fecha_hasta IS NULL)
                        ORDER BY id DESC LIMIT 1"));


//        return DB::table('precio_fason')
////            ->where(function($query) {
////                $query->where([
////                    ['fecha_desde', '>=', getdate()],
////                    ['fecha_hasta', '<=', getdate()]
////                ])->orWhere('fecha_hasta', '=', null);
////            })
//            ->where([
//                ['fecha_desde', '>=', getdate()],
//                ['fecha_hasta', '<=', getdate()]
//            ])
//            ->orWhere('fecha_hasta', '=', null)
//            ->orderByDesc('id')
//            ->get()->first();
    }


    public static function isPrecioValido($precioXtn)
    {
        $precioRef = self::getPrecioReferencia();
        $precio = $precioRef['precio_por_tn'];
        $variacion = $precioRef['variacion_admitida'];
        $min = $precio - $variacion * $precio;
        $max = $precio + $variacion * $precio;

        return ($precioXtn >= $min && $precioXtn <= $max);
    }

}
