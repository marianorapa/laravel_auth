<?php

namespace App\Observers;

use App\Movimiento;
use App\MovimientoInsumo;
use App\MovimientoInsumoNoTrazable;
use App\MovimientoInsumoOrdenProduccionDetalle;
use App\PrestamoCliente;
use App\TipoMovimiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrestamoObserver
{

    //

    public function updated(PrestamoCliente $prestamo){
        if ($prestamo->anulado){
            /* Si se esta anulando un prestamo que ya tenia cantidad cancelada por el cliente,
            hay que devolverle esa cantidad al cliente y quitarsela a la fabrica */

            if ($prestamo->cancelado > 0){

                $data = DB::table('op_detalle_no_trazable as opnt')
                    ->where('opnt.id', '=', $prestamo->op_detalle_id)
                    ->join('orden_de_produccion_detalle as opd', 'opd.id', 'opnt.op_detalle_id')
                    ->join('orden_de_produccion as op', 'op.id', 'opd.op_id')
                    ->join('alimento as a', 'a.id', 'op.producto_id')
                    ->select('a.cliente_id', 'opnt.insumo_id')->get()->first();

                $idCliente = $data->cliente_id;
                $idInsumo = $data->insumo_id;

                $movimientoCliente = new Movimiento();
                $movimientoCliente->tipo_movimiento_id = TipoMovimiento::REINTEGRO_CANCELACION_PRESTAMO;
                $movimientoCliente->user()->associate(Auth::user());
                $movimientoCliente->save();

                $movimientoInsumoCliente = new MovimientoInsumo();
                $movimientoInsumoCliente->cliente_id = $idCliente;
                $movimientoInsumoCliente->cantidad = $prestamo->cancelado;
                $movimientoInsumoCliente->movimiento()->associate($movimientoCliente);
                $movimientoInsumoCliente->save();

                $movimientoInsumoNtCliente = new MovimientoInsumoNoTrazable();
                $movimientoInsumoNtCliente->insumo_id = $idInsumo;
                $movimientoInsumoNtCliente->movimientoInsumo()->associate($movimientoInsumoCliente);
                $movimientoInsumoNtCliente->save();

                $movimientoInsumoOrdProCliente = new MovimientoInsumoOrdenProduccionDetalle();
                $movimientoInsumoOrdProCliente->opd_id = $prestamo->op_detalle_id;
                $movimientoInsumoOrdProCliente->movimientoInsumo()->associate($movimientoInsumoNtCliente);
                $movimientoInsumoOrdProCliente->save();


                /* Ahora creo un movimiento analogo pero negativo para la fabrica */

                $movimientoFabrica = new Movimiento();
                $movimientoFabrica->tipo_movimiento_id = TipoMovimiento::REINTEGRO_CANCELACION_PRESTAMO;
                $movimientoFabrica->user()->associate(Auth::user());
                $movimientoFabrica->save();

                $movimientoInsumoFabrica = new MovimientoInsumo();
                $movimientoInsumoFabrica->cliente_id = 1;
                $movimientoInsumoFabrica->cantidad = 0 - $prestamo->cancelado;
                $movimientoInsumoFabrica->movimiento()->associate($movimientoFabrica);
                $movimientoInsumoFabrica->save();

                $movimientoInsumoNtFabrica = new MovimientoInsumoNoTrazable();
                $movimientoInsumoNtFabrica->insumo_id = $idInsumo;
                $movimientoInsumoNtFabrica->movimientoInsumo()->associate($movimientoInsumoFabrica);
                $movimientoInsumoNtFabrica->save();

                $movimientoInsumoOrdProFabrica = new MovimientoInsumoOrdenProduccionDetalle();
                $movimientoInsumoOrdProFabrica->opd_id = $prestamo->op_detalle_id;
                $movimientoInsumoOrdProFabrica->movimientoInsumo()->associate($movimientoInsumoNtFabrica);
                $movimientoInsumoOrdProFabrica->save();

            }
        }
    }

}
