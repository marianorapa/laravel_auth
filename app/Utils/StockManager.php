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
use Illuminate\Support\Facades\Auth;
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
            ->join('lote_insumo_especifico as lie', 'lie.id', 'mt.insumo_id')
            ->where('lie.nro_lote', '=', $lote)
            ->join('movimiento_insumo as mi', 'mi.id', 'mt.id')
            ->where('mi.cliente_id', '=', $idCliente)
            ->sum('mi.cantidad');
        //->select(DB::raw('sum(mi.cantidad)'))->get()->first();
    }

    public static function getStockIdLoteCliente($idCliente, $id_lote)
    {
        return DB::table('movimiento_insumo_ins_tra as mt')
            ->join('lote_insumo_especifico as lie', 'lie.id', 'mt.insumo_id')
            ->where('lie.id', '=', $id_lote)
            ->join('movimiento_insumo as mi', 'mi.id', 'mt.id')
            ->where('mi.cliente_id', '=', $idCliente)
            ->sum('mi.cantidad');
        //->select(DB::raw('sum(mi.cantidad) as stock'))->get()->first();
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
        $movimientoProducto = self::createMovimientoProducto($idProducto, $cantidad, TipoMovimiento::AJUSTE_STOCK_MANUAL);

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
            ->select('opd.id', 'opdt.lote_insumo_id', 'opd.cantidad')
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
            ->select('opnt.id as opnt_id', 'opd.id', 'opnt.insumo_id', 'opnt.cliente_id', 'opd.cantidad')
            ->where('opd.op_id', '=', $op->id)
            ->get();


        foreach ($detallesNoTrazables as $detalle) {
            $movimientoInsumo = self::createMovimientoInsumo(
                TipoMovimiento::getMovimiento(TipoMovimiento::ANULACION_OP),
                $detalle->cliente_id, $detalle->cantidad
            );

            /* Verifico si es un prestamo, que hay que anular */
            $prestamo = PrestamoCliente::all()
                ->where('op_detalle_id', '=', $detalle->opnt_id)->first();

            if (!is_null($prestamo)) {
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

    private static function createMovimientoInsumo($tipoMovimiento, $idCliente, $cantidad, $observacion = "")
    : MovimientoInsumo
    {
        $movimiento = new Movimiento();
        $movimiento->user()->associate(Auth::user()); // Cambiado
        $movimiento->tipoMovimiento()->associate($tipoMovimiento);
        $movimiento->observacion = $observacion;
        $movimiento->save();

        $movimientoInsumo = new MovimientoInsumo();
        $movimientoInsumo->movimiento()->associate($movimiento);
        $movimientoInsumo->cliente_id = $idCliente;
        $movimientoInsumo->cantidad = $cantidad;
        $movimientoInsumo->save();

        return $movimientoInsumo;
    }

    public static function getListadoStockInsumos($cliente)
    {
        $stockNt = DB::table('cliente as c')->join('empresa as e', 'c.id', 'e.id')
            ->where('e.denominacion', 'like', "%$cliente%")
            ->join('movimiento_insumo as mi', 'mi.cliente_id', 'c.id')
            ->join('movimiento_insumo_ins_no_tra as mnt', 'mnt.id', 'mi.id')
            ->join('insumo as i', 'mnt.insumo_id', 'i.id')
            ->select(DB::raw('sum(mi.cantidad) as stock'), 'e.denominacion as cliente', 'i.descripcion',
                'i.id as id_insumo', 'e.id as cliente_id')
            ->groupBy('cliente')->groupBy('i.descripcion')->groupBy('i.id')->groupBy('e.id')->get();

        $stockT = DB::table('cliente as c')->join('empresa as e', 'c.id', 'e.id')
            ->where('e.denominacion', 'like', "%$cliente%")
            ->join('movimiento_insumo as mi', 'mi.cliente_id', 'c.id')
            ->join('movimiento_insumo_ins_tra as mt', 'mt.id', 'mi.id')
            ->join('lote_insumo_especifico as lie', 'lie.id', 'mt.insumo_id')
            ->join('insumo_especifico as ie', 'ie.gtin', 'lie.insumo_especifico')
            ->join('insumo as i', 'i.id', 'ie.insumo_trazable_id')
            ->join('proveedor as p', 'p.id', 'ie.proveedor_id')
            ->join('empresa as e2', 'e2.id', 'p.id')
            ->select(DB::raw('sum(mi.cantidad) as stock'), 'e.denominacion as cliente',
                'i.descripcion', 'lie.nro_lote', 'e2.denominacion as proveedor',
                'lie.id as id_lote_ins_especifico', 'e.id as cliente_id')
            ->groupBy('cliente')->groupBy('i.descripcion')->groupBy('proveedor')
            ->groupBy('lie.nro_lote')->groupBy('lie.id')->groupBy('e.id')->get();


        return $stockT->merge($stockNt)->sortBy('cliente');

//        return $stockT->union($stockNt)->sortBy('cliente');
    }

    public static function getListadoStockProductos($cliente)
    {
        return DB::table('cliente as c')->join('empresa as e', 'c.id', 'e.id')
            ->where('e.denominacion', 'like', "%$cliente%")
            ->join('alimento as a', 'a.cliente_id', 'c.id')
            ->join('movimiento_producto as mp', 'mp.producto_id', 'a.id')
            ->select(DB::raw('sum(mp.cantidad) as stock'),
                'a.descripcion as producto', 'e.denominacion as cliente', 'a.id')
            ->groupBy('a.descripcion', 'e.denominacion', 'a.id')->get();
    }

    public static function getStockProducto($id): int
    {
        return DB::table('alimento as a')->where('a.id', '=', $id)
            ->join('movimiento_producto as mp', 'mp.producto_id', 'a.id')
            ->sum('mp.cantidad');
    }


    public static function ajusteStockInsumoTrazable($idLoteInsumo, $idCliente, $ajuste, $observacion = "")
    {
        $tipo = TipoMovimiento::AJUSTE_STOCK_MANUAL;
        $movimientoInsumo = self::createMovimientoInsumo($tipo, $idCliente, $ajuste, $observacion);

        $movimientoInsumoTrazable = new MovimientoInsumoTrazable();
        $movimientoInsumoTrazable->insumo_id = $idLoteInsumo;
        $movimientoInsumoTrazable->movimientoInsumo()->associate($movimientoInsumo);

        $movimientoInsumoTrazable->save();
    }

    public static function ajusteStockInsumoNoTrazable($idInsumo, $idCliente, $ajuste, $observacion = "")
    {
        $tipo = TipoMovimiento::AJUSTE_STOCK_MANUAL;
        $movimientoInsumo = self::createMovimientoInsumo($tipo, $idCliente, $ajuste, $observacion);

        $movimientoInsumoNoTrazable = new MovimientoInsumoNoTrazable();
        $movimientoInsumoNoTrazable->insumo_id = $idInsumo;
        $movimientoInsumoNoTrazable->movimientoInsumo()->associate($movimientoInsumo);

        $movimientoInsumoNoTrazable->save();
    }

    public static function ajusteStockProducto($id, $ajuste, $observacion = "")
    {
        $tipo = TipoMovimiento::AJUSTE_STOCK_MANUAL;
        self::createMovimientoProducto($id, $ajuste, $tipo, $observacion);
    }

    /**
     * @param $idProducto
     * @param $cantidad
     * @return MovimientoProducto
     */
    protected static function createMovimientoProducto($idProducto, $cantidad, $tipoMovimiento, $observacion = "")
    : MovimientoProducto
    {
        $movimiento = new Movimiento();
        $movimiento->user()->associate(Auth::user()); // Cambiado
        $movimiento->tipoMovimiento()->associate(TipoMovimiento::getMovimiento($tipoMovimiento));
        $movimiento->observacion = $observacion;
        $movimiento->save();

        $movimientoProducto = new MovimientoProducto();
        $movimientoProducto->producto_id = $idProducto;
        $movimientoProducto->movimiento()->associate($movimiento);
        $movimientoProducto->cantidad = $cantidad;
        $movimientoProducto->save();
        return $movimientoProducto;
    }

}
