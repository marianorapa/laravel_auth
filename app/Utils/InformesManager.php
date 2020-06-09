<?php


namespace App\Utils;


use Illuminate\Support\Facades\DB;

class InformesManager
{


    public static function getInformeEstadistico($desde, $hasta)
    {
        $kgsFabricados = DB::table('orden_de_produccion as op')
            ->where([
                ['op.fecha_fabricacion', '>=', $desde],
                ['op.fecha_fabricacion', '<=', $hasta],
                ['op.anulada', '=', false]
                ])
            ->sum('op.cantidad');

        $kgsAnulados = DB::table('orden_de_produccion as op')
            ->where([
                ['op.fecha_fabricacion', '>=', $desde],
                ['op.fecha_fabricacion', '<=', $hasta],
                ['op.anulada', '=', true]
            ])
            ->sum('op.cantidad');

        $prodMasFreq = DB::table('orden_de_produccion as op')
            ->where([
                ['op.fecha_fabricacion', '>=', $desde],
                ['op.fecha_fabricacion', '<=', $hasta],
                ['op.anulada', '=', false]
            ])
            ->join('alimento as a', 'a.id', 'op.producto_id')
            ->join('empresa as e', 'e.id', 'a.cliente_id')
            ->select(DB::raw("COUNT(op.producto_id) as count, sum(op.cantidad) as suma"),
                'op.producto_id', 'a.descripcion', 'e.denominacion')
            ->groupBy('op.producto_id', 'a.descripcion', 'e.denominacion')->orderByDesc('count')->limit(1)->get();

        $prodMasKgs = DB::table('orden_de_produccion as op')
            ->where([
                ['op.fecha_fabricacion', '>=', $desde],
                ['op.fecha_fabricacion', '<=', $hasta],
                ['op.anulada', '=', false]
            ])
            ->join('alimento as a', 'a.id', 'op.producto_id')
            ->join('empresa as e', 'e.id', 'a.cliente_id')
            ->select(DB::raw("COUNT(op.producto_id) as count, sum(op.cantidad) as suma"),
                'op.producto_id', 'a.descripcion', 'e.denominacion')
            ->groupBy('op.producto_id', 'a.descripcion', 'e.denominacion')->orderByDesc('suma')->limit(1)->get();

//        dd($kgsFabricados, $kgsAnulados, $prodMasFreq, $prodMasKg);

        return ['kgsFabricados' => $kgsFabricados,
                'kgsAnulados' => $kgsAnulados,
                'prodMasFreq' => $prodMasFreq,
                'prodMasKgs' => $prodMasKgs
        ];
    }
}
