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
            ->join('cliente as c', 'c.id', '=', 'a.cliente_id')
            ->where('c.id','=',$id_cliente)
            ->sum('opd.cantidad');

        $devuelto = DB::table('prestamo_devoluciones as pd')
            ->join('prestamo_cliente as p', 'pd.prestamo_id', '=', 'p.id')
            ->join('orden_de_produccion_detalle as opd', 'opd.id', '=', 'p.op_detalle_id')
            ->join('orden_de_produccion as op','op.id','=','opd.op_id')
            ->join('alimento as a','op.producto_id','=','a.id')
            ->join('cliente as c', 'c.id', '=', 'a.cliente_id')
            ->where('c.id','=',$id_cliente)
            ->sum('pd.cantidad');

        return $limite - $prestado + $devuelto;
    }
}
