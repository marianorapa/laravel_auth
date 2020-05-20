<?php


namespace App\Utils;


use Illuminate\Support\Facades\DB;

class StockManager
{


    public static function getLotesStockCliente($id_insumo, $id_cliente)
    {
        $movimientos = DB::table('movimiento as mov')
            ->join('movimiento_insumo as m', 'm.id', '=','mov.id')
            ->where('m.cliente_id', '=', $id_cliente)
            ->join('movimiento_insumo_ins_tra as mt', 'mt.id','=', 'm.id')
            ->join('lote_insumo_especifico as lie', 'lie.id','=', 'mt.insumo_id')
            ->join('insumo_especifico as ie','ie.gtin','=', 'lie.insumo_especifico')
            ->where('ie.insumo_trazable_id','=', $id_insumo)
            ->select('lie.nro_lote',DB::raw('sum(m.cantidad) as cantidad'))
            ->groupBy('lie.nro_lote')
            ->get(); // tremendo este query ;)
        return ($movimientos->toArray());
    }

    public static function getStockInsumoNoTrazableCliente($id_insumo, \Illuminate\Database\Query\Builder $id_cliente)
    {
    }

    public static function getStockInsumoFabrica($id_insumo)
    {
    }
}
