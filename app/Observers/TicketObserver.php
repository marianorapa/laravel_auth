<?php

namespace App\Observers;

use App\EstadoTicket;
use App\EstadoTicketTicket;
use App\Movimiento;
use App\MovimientoInsumo;
use App\MovimientoInsumoNoTrazable;
use App\MovimientoInsumoTicketEntrada;
use App\MovimientoInsumoTrazable;
use App\MovimientoProducto;
use App\MovimientoProductoTicketSalida;
use App\Ticket;
use App\TipoMovimiento;
use App\User;
use App\Utils\PrestamosManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketObserver
{
    /**
     * Handle the ticket "created" event.
     *
     * @param  \App\Ticket  $ticket
     * @return void
     */
    public function created(Ticket $ticket)
    {
        //
        // Insertar estado ticket en proceso
        $estadoTicket = new EstadoTicketTicket();
        $estadoTicket->ticket()->associate($ticket);
        $estadoTicket->estadoTicket()->associate(EstadoTicket::getEstadoEnProceso());
        $estadoTicket->user()->associate(User::all()->first()); // TODO Cambiar a usuario logueado
        $estadoTicket->save();

    }

    public function updating(Ticket $ticket)
    {
        // Antes de insertar el ticket, calculo el neto si es que existe el segundo pesaje
        if ($ticket->ticketEntrada()->exists()) {
            /*Si es de entrada */
            if ($ticket->tara()->exists()) {
                /*Si se le asigno el segundo pesaje*/
                $ticket->neto = $ticket->bruto()->get()->first()->peso - $ticket->tara()->get()->first()->peso;
            }
        }
        else {
            if ($ticket->ticketSalida()->exists()){
                if ($ticket->bruto()->exists()) {
                    $ticket->neto = $ticket->bruto()->get()->first()->peso - $ticket->tara()->get()->first()->peso;
                }
            }
        }
    }

    /**
     * Handle the ticket "updated" event.
     *
     * @param  \App\Ticket  $ticket
     * @return void
     */
    public function updated(Ticket $ticket)
    {
        /** Registrar movimientos al modificar un ticket **/

        // 1. Detecto si es de entrada o salida
        if ($ticket->ticketEntrada()->exists()) {
            /*Si es de entrada */
            if ($ticket->tara()->exists()){
                // TODO mover esto a un pesajeObserver, para que solo se ejecute una vez al insertar el pesaje
                $this->finalizarTicketEntrada($ticket);
            }
        }
        elseif ($ticket->ticketSalida()->exists()){
            /* Si es de salida */
            if ($ticket->bruto()->exists()) {
                $this->finalizarTicketSalida($ticket);
            }
        }

        // Siempre insertar estado ticket finalizado porque no permitimos actualizar de otra manera
        $estadoTicket = new EstadoTicketTicket();
        $estadoTicket->ticket()->associate($ticket);
        $estadoTicket->estadoTicket()->associate(EstadoTicket::getEstadoFinalizado());
        $estadoTicket->user()->associate(Auth::user()); // Cambiado
        $estadoTicket->save();
    }

    /**
     * Handle the ticket "deleted" event.
     *
     * @param  \App\Ticket  $ticket
     * @return void
     */
    public function deleted(Ticket $ticket)
    {
        //
        $estadoTicket = new EstadoTicketTicket();
        $estadoTicket->ticket()->associate($ticket);

        $estadoTicket->estadoTicket()->associate(EstadoTicket::getEstadoAnulado());
        $estadoTicket->user()->associate(Auth::user()); // Cambiado

        $estadoTicket->save();
    }

    /**
     * Handle the ticket "restored" event.
     *
     * @param  \App\Ticket  $ticket
     * @return void
     */
    public function restored(Ticket $ticket)
    {
        //
    }

    /**
     * Handle the ticket "force deleted" event.
     *
     * @param  \App\Ticket  $ticket
     * @return void
     */
    public function forceDeleted(Ticket $ticket)
    {
        //
    }

    /**
     * @param Ticket $ticket
     */
    protected function finalizarTicketEntrada(Ticket $ticket): void
    {
        $movimiento = new Movimiento();

        $movimiento->user()->associate(Auth::user()); // Cambiado

        $tipoMovimiento = TipoMovimiento::getMovimiento(TipoMovimiento::FINALIZACION_ENTRADA);
        $movimiento->tipoMovimiento()->associate($tipoMovimiento);
        $movimientoInsumo = new MovimientoInsumo();
        $movimientoInsumo->cliente()->associate($ticket->cliente()->first());

        $movimientoInsumoTkte = new MovimientoInsumoTicketEntrada();
        $movimientoInsumoTkte->ticketEntrada()->associate($ticket);

        $noEsTrazable = DB::table('ticket_entrada_insumo_no_trazable')
            ->where('id', '=', $ticket->id)
            ->exists();

        if ($noEsTrazable) {

            $insumo = DB::table('ticket_entrada_insumo_no_trazable')
                ->where('id', '=', $ticket->id)
                ->select('insumo_nt_id')
                ->get()->first();

            $idInsumo = $insumo->insumo_nt_id;

            /* Solo en caso que no sea trazable, puede existir deuda */
            $cantRestante = PrestamosManager::registrarDevolucionInsumo(
                $ticket->cliente_id, $idInsumo, $ticket->id, $ticket->neto
            );

//            $ticket->neto = $cantRestante;

            if ($cantRestante > 0) {
                // Tengo que registrar el movimiento pq le queda cantidad
                $movimientoInsumo->cantidad = $cantRestante;

                $movimiento->save();
                $movimientoInsumo->movimiento()->associate($movimiento);
                $movimientoInsumo->save();
                $movimientoInsumoTkte->movimiento()->associate($movimientoInsumo);
                $movimientoInsumoTkte->save();

                $movimientoInsumoNoTrazable = new MovimientoInsumoNoTrazable();
                $movimientoInsumoNoTrazable->insumo_id = $idInsumo;
                $movimientoInsumoNoTrazable->movimientoInsumo()->associate($movimientoInsumo);

                $movimientoInsumoNoTrazable->save();
            } else {
                // No registro movimiento, xq no le queda "cantidad restante"
            }
        } else {
            // Si es trazable
            $movimiento->save();
            $movimientoInsumo->movimiento()->associate($movimiento);
            $movimientoInsumo->cantidad = $ticket->neto;
            $movimientoInsumo->save();
            $movimientoInsumoTkte->movimiento()->associate($movimientoInsumo);
            $movimientoInsumoTkte->save();

            $movimientoInsumoTrazable = new MovimientoInsumoTrazable();
            $movimientoInsumoTrazable->movimientoInsumo()->associate($movimientoInsumo);

            $ticketEntradaInsumoTrazable = $ticket->ticketEntrada()->first()
                ->ticketEntradaInsumoTrazable()->get()->first();

            $loteInsumoEspecifico = $ticketEntradaInsumoTrazable->loteInsumoEspecifico()->first();
            $movimientoInsumoTrazable->loteInsumoEspecifico()->associate($loteInsumoEspecifico);

            $movimientoInsumoTrazable->save();
        }
    }

    private function finalizarTicketSalida(Ticket $ticket)
    {
        $movimiento = new Movimiento();
//               $movimiento->user()->associate(Auth::user()); Pendiente para cuando este protegida la ruta

        $movimiento->user()->associate(Auth::user()); // Cambiado

        $tipoMovimiento = TipoMovimiento::getMovimiento(TipoMovimiento::FINALIZACION_SALIDA);
        $movimiento->tipoMovimiento()->associate($tipoMovimiento);

        $movimiento->save();

        $movimientoProducto = new MovimientoProducto();

        $idProducto = DB::table('ticket_salida as ts')->where('ts.id', '=', $ticket->id)
            ->join('orden_de_produccion as op', 'op.id', 'ts.op_id')
            ->select('op.producto_id')->get()->first()->producto_id;

        $movimientoProducto->movimiento()->associate($movimiento);
        $movimientoProducto->producto_id = $idProducto;
        $movimientoProducto->cantidad = 0 - $ticket->neto;
        $movimientoProducto->save();

        $movimientoProductoTktSalida = new MovimientoProductoTicketSalida();
        $movimientoProductoTktSalida->movimientoProducto()->associate($movimientoProducto);
        $movimientoProductoTktSalida->tkt_sal_id = $ticket->id;
        $movimientoProductoTktSalida->save();
    }
}
