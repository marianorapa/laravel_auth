<?php

namespace App\Utils;

use App\Pesaje;
use App\Ticket;
use Illuminate\Support\Facades\DB;

class TicketsSalidaManager
{
    public static function finalizarTicket($id, Pesaje $pesaje)
    {
        $ticket = Ticket::find($id);

        /* Antes de seguir, verifica que no pese mas que lo que queda de la OP*/

        $saldoOp = DB::table('ticket_salida as ts')->where('ts.id', '=', $id)
            ->join('orden_de_produccion as op', 'op.id', 'ts.op_id')
            ->select('op.saldo')->get()->first()->saldo;

        $tara = $ticket->tara()->first()->peso;

        $neto = $pesaje->peso - $tara;

        if ($saldoOp >= $neto) {
            $ticket->bruto = $pesaje->id;

            $ticket->save();
        }
        else {
            return back()->with('error', 'El monto a retirar supera el saldo de la orden de producción seleccionada');
        }
    }
}
