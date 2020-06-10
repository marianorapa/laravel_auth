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
            ->select(DB::raw('sum(op.cantidad) as cantidad'),
                DB::raw('sum(op.precio_venta_por_tn*cantidad/1000) as ingresos'))->get();

        $kgsAnulados = DB::table('orden_de_produccion as op')
            ->where([
                ['op.fecha_fabricacion', '>=', $desde],
                ['op.fecha_fabricacion', '<=', $hasta],
                ['op.anulada', '=', true]
            ])
            ->select(DB::raw('sum(op.cantidad) as cantidad'),
                DB::raw('sum(op.precio_venta_por_tn*cantidad/1000) as ingresos'))->get();

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

//        dd($kgsFabricados, $kgsAnulados, $prodMasFreq, $prodMasKgs);

        return ['kgsFabricados' => $kgsFabricados[0]->cantidad,
                'ingresosFabricados' => $kgsFabricados[0]->ingresos,
                'kgsAnulados' => $kgsAnulados[0]->cantidad,
                'ingresosAnulados' => $kgsAnulados[0]->ingresos,
                'prodMasFreq' => $prodMasFreq,
                'prodMasKgs' => $prodMasKgs
        ];
    }
}
