<?php


namespace App\Utils;


use App\Movimiento;
use App\MovimientoInsumo;
use App\MovimientoInsumoNoTrazable;
use App\MovimientoInsumoTicketEntrada;
use App\PrestamoDevolucion;
use App\TipoMovimiento;
use App\User;
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

    public static function registrarDevolucionFabrica(PrestamoDevolucion $prestamoDevolucion){

        $movimiento = new Movimiento();
        $movimiento->tipoMovimiento()->associate(TipoMovimiento::getMovimiento(TipoMovimiento::DEVOLUCION_INSUMOS));
//        $movimiento->user()->associate(Auth::user()); TODO cambiar a usuario logueado
        $movimiento->user()->associate(User::all()->first());
        $movimiento->save();

        $movimientoInsumo = new MovimientoInsumo();
        $movimientoInsumo->movimiento()->associate($movimiento);
        $movimientoInsumo->cliente_id = 1; // La fabrica
        $movimientoInsumo->cantidad = $prestamoDevolucion->cantidad;
        $movimientoInsumo->save();

        $movimientoInsumoNoTra = new MovimientoInsumoNoTrazable();
        $movimientoInsumoNoTra->movimientoInsumo()->associate($movimientoInsumo);

        $idInsumo = DB::table('prestamo_cliente as pc')
            ->where('pc.id', '=', $prestamoDevolucion->prestamo_id)
            ->join('op_detalle_no_trazable as opnt', 'opnt.id', '=','pc.op_detalle_id')
            ->select('opnt.insumo_id')->get();

        $movimientoInsumoNoTra->insumo_id = $idInsumo;

        $movimientoInsumoNoTra->save();

        $movimientoInsumoTicketEntrada = new MovimientoInsumoTicketEntrada();
        $movimientoInsumoTicketEntrada->movimientoInsumo()->associate($movimientoInsumo);
        $movimientoInsumoTicketEntrada->ticket_id = $prestamoDevolucion->ticket_entrada_id;
        $movimientoInsumoTicketEntrada->save();
    }
}
