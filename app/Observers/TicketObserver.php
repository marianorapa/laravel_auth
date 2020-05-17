<?php

namespace App\Observers;

use App\Movimiento;
use App\MovimientoInsumo;
use App\MovimientoInsumoNoTrazable;
use App\MovimientoInsumoTicketEntrada;
use App\MovimientoInsumoTrazable;
use App\Ticket;
use App\TipoMovimiento;
use App\User;

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

                /*Si se le asigno el segundo pesaje*/
                $ticket->neto = $ticket->bruto()->get()->first()->peso - $ticket->tara()->get()->first()->peso;

                $movimiento = new Movimiento();
//                $movimiento->user()->associate(Auth::user()); Pendiente para cuando este protegida la ruta

                $movimiento->user()->associate(User::all()->first());

                $tipoMovimiento = TipoMovimiento::getMovimiento(TipoMovimiento::FINALIZACION_ENTRADA);
                $movimiento->tipoMovimiento()->associate($tipoMovimiento);
                $movimiento->save();

                $movimientoInsumo = new MovimientoInsumo();

                $movimientoInsumo->cliente()->associate($ticket->cliente()->first());

                $movimientoInsumo->cantidad = $ticket->neto;

                $movimientoInsumo->save();

                $movimientoInsumoTkte = new MovimientoInsumoTicketEntrada();
                $movimientoInsumoTkte->movimiento()->associate($movimientoInsumo);
                $movimientoInsumoTkte->ticketEntrada()->associate($ticket);
                $movimientoInsumoTkte->save();

                // 1.1 Detecto si es ticketEntradaTrazable o noTrazable
                if ($ticket->ticketEntrada()->first()->ticketEntradaInsumoTrazable()->exists()){
                    /* Si es trazable */
                    $movimientoInsumoTrazable = new MovimientoInsumoTrazable();
                    $movimientoInsumoTrazable->movimientoInsumo()->associate($movimientoInsumo);

                    $ticketEntradaInsumoTrazable = $ticket->ticketEntrada()->first()
                        ->ticketEntradaInsumoTrazable()->get()->first();

                    $loteInsumoEspecifico = $ticketEntradaInsumoTrazable->loteInsumoEspecifico()->first();
                    $movimientoInsumoTrazable->loteInsumoEspecifico()->associate($loteInsumoEspecifico);

                    $movimientoInsumoTrazable->save();
                }
                elseif ($ticket->ticketEntrada()->first()->ticketEntradaInsumoNoTrazable()->exists()){
                    /* Si no es trazable */
                    $ticketEntradaInsumoNoTrazable = $ticket->ticketEntrada()
                        ->first()->ticketEntradaInsumoNoTrazable()->get()->first();

                    $movimientoInsumoNoTrazable = new MovimientoInsumoNoTrazable();

                    $insumoNoTrazable = $ticketEntradaInsumoNoTrazable->insumoNoTrazable()->first();

                    $movimientoInsumoNoTrazable->insumoNoTrazable()->associate($insumoNoTrazable);
                    $movimientoInsumoNoTrazable->save();
                }
            }
        }
        elseif ($ticket->ticketSalida()->exists()){
            /* Si es de salida */
        }
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
}
