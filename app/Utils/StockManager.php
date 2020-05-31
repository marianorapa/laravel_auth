<?php


namespace App\Utils;


use App\Movimiento;
use App\MovimientoInsumo;
use App\MovimientoInsumoNoTrazable;
use App\MovimientoInsumoOrdenProduccionDetalle;
use App\MovimientoInsumoTicketEntrada;
use App\MovimientoInsumoTrazable;
use App\MovimientoProducto;
use App\MovimientoProductoOrdenProduccion;
use App\PrestamoCliente;
use App\PrestamoDevolucion;
use App\TipoMovimiento;
use App\User;
use Illuminate\Support\Facades\DB;

class StockManager
{

    public static function getLotesStockCliente($id_insumo, $id_cliente): array
    {
        $lotes = DB::table('movimiento as mov')   // Pense que necesitaba mov pero no, queda x las dudas
        ->join('movimiento_insumo as m', 'm.id', '=', 'mov.id')
            ->where('m.cliente_id', '=', $id_cliente)
            ->join('movimiento_insumo_ins_tra as mt', 'mt.id', '=', 'm.id')
            ->join('lote_insumo_especifico as lie', 'lie.id', '=', 'mt.insumo_id')
            ->join('insumo_especifico as ie', 'ie.gtin', '=', 'lie.insumo_especifico')
            ->where('ie.insumo_trazable_id', '=', $id_insumo)
            ->select('lie.nro_lote', DB::raw('sum(m.cantidad) as cantidad'))
            ->groupBy('lie.nro_lote')
            ->get(); // tremendo este query ;)
        return ($lotes->toArray());
    }

    public static function getStockInsumoNoTrazableCliente($id_insumo, $id_cliente)
    {
        return DB::table('movimiento_insumo as mi')
            ->where('mi.cliente_id', '=', $id_cliente)
            ->join('movimiento_insumo_ins_no_tra as mnt', 'mnt.id', '=', 'mi.id')
            ->where('mnt.insumo_id', '=', $id_insumo)
            ->sum('mi.cantidad');
    }

    public static function getStockInsumoFabrica($id_insumo)
    {
        return DB::table('movimiento_insumo as mi')
            ->where('mi.cliente_id', '=', 1)
            ->join('movimiento_insumo_ins_no_tra as mnt', 'mnt.id', '=', 'mi.id')
            ->where('mnt.insumo_id', '=', $id_insumo)
            ->sum('mi.cantidad');
    }


    public static function getStockLoteCliente($idCliente, $lote)
    {
        return DB::table('movimiento_insumo_ins_tra as mt')
            ->join('lote_insumo_especifico as lie', 'lie.id', 'mt.id')
            ->where('lie.nro_lote', '=', $lote)
            ->join('movimiento_insumo as mi', 'mi.id', 'mt.id')
            ->where('mi.cliente_id', '=', $idCliente)
            ->get();
    }

    public static function registrarDevolucionFabrica(PrestamoDevolucion $prestamoDevolucion)
    {

        $movimientoInsumo = self::createMovimientoInsumo(
            TipoMovimiento::getMovimiento(TipoMovimiento::DEVOLUCION_INSUMO), 1, $prestamoDevolucion->cantidad
        );

        $movimientoInsumoNoTra = new MovimientoInsumoNoTrazable();
        $movimientoInsumoNoTra->movimientoInsumo()->associate($movimientoInsumo);

        $idInsumo = DB::table('prestamo_cliente as pc')
            ->where('pc.id', '=', $prestamoDevolucion->prestamo_id)
            ->join('op_detalle_no_trazable as opnt', 'opnt.id', '=', 'pc.op_detalle_id')
            ->select('opnt.insumo_id')->get()->first()->insumo_id;

        $movimientoInsumoNoTra->insumo_id = $idInsumo;

        $movimientoInsumoNoTra->save();

        $movimientoInsumoTicketEntrada = new MovimientoInsumoTicketEntrada();
        $movimientoInsumoTicketEntrada->movimientoInsumo()->associate($movimientoInsumo);
        $movimientoInsumoTicketEntrada->ticket_id = $prestamoDevolucion->ticket_entrada_id;
        $movimientoInsumoTicketEntrada->save();
    }

    public static function registrarConsumoOpTrazable(int $opDetalleId, int $idLoteInsumo,
                                                      int $idCliente, $cantidad)
    {
        $movimientoInsumo = self::createMovimientoInsumo(
            TipoMovimiento::getMovimiento(TipoMovimiento::CONSUMO_OP), $idCliente, 0 - $cantidad
        );

        $movimientoInsumoTrazable = new MovimientoInsumoTrazable();
        $movimientoInsumoTrazable->insumo_id = $idLoteInsumo;
        $movimientoInsumoTrazable->movimientoInsumo()->associate($movimientoInsumo);
        $movimientoInsumoTrazable->save();

        $movimientoInsumoOrdenProduccionDetalle = new MovimientoInsumoOrdenProduccionDetalle();
        $movimientoInsumoOrdenProduccionDetalle->opd_id = $opDetalleId;
        $movimientoInsumoOrdenProduccionDetalle->movimientoInsumo()->associate($movimientoInsumo);
        $movimientoInsumoOrdenProduccionDetalle->save();
    }

    public static function registrarConsumoOpNoTrazable(int $opDetalleId,
                                                        int $idInsumo, int $idCliente, $cantidad)
    {
        $movimientoInsumo = self::createMovimientoInsumo(
            TipoMovimiento::getMovimiento(TipoMovimiento::CONSUMO_OP), $idCliente, 0 - $cantidad
        );

        $movimientoInsumoNoTrazable = new MovimientoInsumoNoTrazable();
        $movimientoInsumoNoTrazable->insumo_id = $idInsumo;
        $movimientoInsumoNoTrazable->movimientoInsumo()->associate($movimientoInsumo);
        $movimientoInsumoNoTrazable->save();

        $movimientoInsumoOrdenProduccionDetalle = new MovimientoInsumoOrdenProduccionDetalle();
        $movimientoInsumoOrdenProduccionDetalle->opd_id = $opDetalleId;
        $movimientoInsumoOrdenProduccionDetalle->movimientoInsumo()->associate($movimientoInsumo);
        $movimientoInsumoOrdenProduccionDetalle->save();
    }


    public static function registrarFinalizacionOp($idProducto, $cantidad, $op)
    {
        /* Creamos un movimiento, movimiento_producto, movimiento_producto_ord_pro */
        $movimiento = new Movimiento();
        $movimiento->user()->associate(User::all()->first()); // TODO Cambiar por usuario logueado
        $movimiento->tipoMovimiento()->associate(TipoMovimiento::getMovimiento(TipoMovimiento::FINALIZACION_OP));
        $movimiento->save();

        $movimientoProducto = new MovimientoProducto();
        $movimientoProducto->producto_id = $idProducto;
        $movimientoProducto->movimiento()->associate($movimiento);
        $movimientoProducto->cantidad = $cantidad;
        $movimientoProducto->save();

        $movimientoProductoOrdPro = new MovimientoProductoOrdenProduccion();
        $movimientoProductoOrdPro->movimientoProducto()->associate($movimientoProducto);
//        $movimientoProductoOrdPro->ordenDeProduccion()->associate($op);
        $movimientoProductoOrdPro->ord_pro_id = $op->id;

        $movimientoProductoOrdPro->save();
    }


    public static function registrarAnulacionOp($op)
    {
        /* TODO Si puede anularse una op cuando estaba finalizada, falta restar stock del prod terminado */

        /* Por el momento, solo restauramos los insumos de la orden */

//        $idClienteOp = $op->alimento()->first()->cliente()->first()->id;
        $idClienteOp = DB::table('orden_de_produccion as op')->where('op.id', '=', $op->id)
            ->join('alimento', 'alimento.id', 'op.producto_id')
            ->select('cliente_id')->get()->first()->cliente_id;

        /* Primero, obtengo todos los detalles trazables de esta orden y sumo un movimiento por cu */
        $detallesTrazables = DB::table('op_detalle_trazable as opdt')
            ->join('orden_de_produccion_detalle as opd', 'opd.id', 'opdt.op_detalle_id')
            ->where('opd.op_id', '=', $op->id)
            ->select('opd.id','opdt.lote_insumo_id', 'opd.cantidad')
            ->get();


        foreach ($detallesTrazables as $detalle) {
            $movimientoInsumo = self::createMovimientoInsumo(
                TipoMovimiento::getMovimiento(TipoMovimiento::ANULACION_OP),
                    $idClienteOp, $detalle->cantidad
            );

            $movimientoInsumoTrazable = new MovimientoInsumoTrazable();
            $movimientoInsumoTrazable->movimientoInsumo()->associate($movimientoInsumo);
            $movimientoInsumoTrazable->insumo_id = $detalle->lote_insumo_id;
            $movimientoInsumoTrazable->save();

            $movimientoInsumoOrdenProduccion = new MovimientoInsumoOrdenProduccionDetalle();
            $movimientoInsumoOrdenProduccion->movimientoInsumo()->associate($movimientoInsumo);
            $movimientoInsumoOrdenProduccion->opd_id = $detalle->id;
            $movimientoInsumoOrdenProduccion->save();
        }

        /* Luego, lo mismo con los detalles no trazables */
        $detallesNoTrazables = DB::table('op_detalle_no_trazable as opnt')
            ->join('orden_de_produccion_detalle as opd', 'opd.id', 'opnt.op_detalle_id')
            ->select('opnt.id as opnt_id', 'opd.id','opnt.insumo_id', 'opnt.cliente_id', 'opd.cantidad')
            ->where('opd.op_id', '=', $op->id)
            ->get();


        foreach($detallesNoTrazables as $detalle){
            $movimientoInsumo = self::createMovimientoInsumo(
                TipoMovimiento::getMovimiento(TipoMovimiento::ANULACION_OP),
                $detalle->cliente_id, $detalle->cantidad
            );

           /* Verifico si es un prestamo, que hay que anular */
           $prestamo = PrestamoCliente::all()
                    ->where('op_detalle_id', '=', $detalle->opnt_id)->first();

            if (!is_null($prestamo)){
                $prestamo->anulado = true;
                $prestamo->save();
            }

            $movimientoInsumoNoTrazable = new MovimientoInsumoNoTrazable();
            $movimientoInsumoNoTrazable->movimientoInsumo()->associate($movimientoInsumo);
            $movimientoInsumoNoTrazable->insumo_id = $detalle->insumo_id;
            $movimientoInsumoNoTrazable->save();

            $movimientoInsumoOrdenProduccion = new MovimientoInsumoOrdenProduccionDetalle();
            $movimientoInsumoOrdenProduccion->movimientoInsumo()->associate($movimientoInsumo);
            $movimientoInsumoOrdenProduccion->opd_id = $detalle->id;
            $movimientoInsumoOrdenProduccion->save();
        }
    }

    private static function createMovimientoInsumo($tipoMovimiento, $idCliente, $cantidad) : MovimientoInsumo
    {
        $movimiento = new Movimiento();
        $movimiento->user()->associate(User::all()->first()); // TODO Cambiar por usuario logueado
        $movimiento->tipoMovimiento()->associate($tipoMovimiento);
        $movimiento->save();

        $movimientoInsumo = new MovimientoInsumo();
        $movimientoInsumo->movimiento()->associate($movimiento);
        $movimientoInsumo->cliente_id = $idCliente;
        $movimientoInsumo->cantidad = $cantidad;
        $movimientoInsumo->save();

        return $movimientoInsumo;
    }

    public static function getListadoStockInsumos()
    {

        // TODO Listado de stock de insumos

        return [];
    }

    public static function getListadoStockProductos()
    {

        // TODO Listado de stock de productos

        return [];
    }

}
