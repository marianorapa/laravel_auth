<?php


namespace App\Utils;


use Illuminate\Support\Facades\DB;

class StockManager
{

    public static function getLotesStockCliente($id_insumo, $id_cliente) : array
    {
        $lotes = DB::table('movimiento as mov')   // Pense que necesitaba mov pero no, queda x las dudas
            ->join('movimiento_insumo as m', 'm.id', '=','mov.id')
            ->where('m.cliente_id', '=', $id_cliente)
            ->join('movimiento_insumo_ins_tra as mt', 'mt.id','=', 'm.id')
            ->join('lote_insumo_especifico as lie', 'lie.id','=', 'mt.insumo_id')
            ->join('insumo_especifico as ie','ie.gtin','=', 'lie.insumo_especifico')
            ->where('ie.insumo_trazable_id','=', $id_insumo)
            ->select('lie.nro_lote',DB::raw('sum(m.cantidad) as cantidad'))
            ->groupBy('lie.nro_lote')
            ->get(); // tremendo este query ;)
        return ($lotes->toArray());
    }

    public static function getStockInsumoNoTrazableCliente($id_insumo, $id_cliente)
    {
        $stock = DB::table('movimiento_insumo as mi')
            ->where('mi.cliente_id', '=', $id_cliente)
            ->join('movimiento_insumo_ins_no_tra as mnt', 'mnt.id','=','mi.id')
            ->where('mnt.insumo_id', '=', $id_insumo)
            ->sum('mi.cantidad');

        return $stock;
    }

    public static function getStockInsumoFabrica($id_insumo)
    {
        $stock = DB::table('movimiento_insumo as mi')
            ->where('mi.cliente_id', '=', 1)
            ->join('movimiento_insumo_ins_no_tra as mnt', 'mnt.id','=','mi.id')
            ->where('mnt.insumo_id', '=', $id_insumo)
            ->sum('mi.cantidad');

        return $stock;
    }
}
