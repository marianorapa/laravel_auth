<?php


namespace App\Utils;


use Illuminate\Support\Facades\DB;

class PrestamosManager
{

    public static function getLimiteRestanteCliente($id_cliente)
    {
        $limite = DB::table('credito_cliente')
            ->where('cliente_id', '=',$id_cliente)
            ->where('fecha_hasta', '=', null)
            ->get()->first();

        $prestado = DB::table('prestamo_cliente as p')
            ->join('orden_de_produccion_detalle as opd', 'opd.id', '=', 'p.op_detalle_id')
            ->join('orden_de_produccion as op','op.id','=','opd.op_id')
            ->join('alimento as a','op.producto_id','=','a.id')
            ->where('a.cliente_id','=',$id_cliente)
            ->sum('opd.cantidad');

        $devuelto = DB::table('prestamo_devoluciones as pd')
            ->join('prestamo_cliente as p', 'pd.prestamo_id', '=', 'p.id')
            ->join('orden_de_produccion_detalle as opd', 'opd.id', '=', 'p.op_detalle_id')
            ->join('orden_de_produccion as op','op.id','=','opd.op_id')
            ->join('alimento as a','op.producto_id','=','a.id')
            ->where('a.cliente_id','=',$id_cliente)
            ->sum('pd.cantidad');

        return $limite - $prestado + $devuelto;
    }


    public static function checkDevolucionInsumo($idCliente, $idInsumo, $idTicketEntrada){
        $deuda = DB::table('prestamo_cliente as p')
            ->where('p.cancelado', '=', null)
            ->join('orden_de_produccion_detalle as opd', 'opd.id', '=', 'p.op_detalle_id')
            ->join('op_detalle_no_trazable as opnt', 'opnt.id', '=', 'opd.id')
            ->where('opnt.insumo_id', '=', $idInsumo)
            ->join('orden_de_produccion as op','op.id','=','opd.op_id')
            ->join('alimento as a','op.producto_id','=','a.id')
            ->where('a.cliente_id','=',$idCliente)
            ->sum('opd.cantidad')
            ->get();

        if ($deuda > 0){
            // Adeuda insumo

            // Busco la cantidad del ingreso en el ticket

            // Registrar devolucion de $deuda, y devuelvo cantidad - $deuda. Puede ser negativo si debia mas
        }
    }


}
