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
use App\Utils\PrestamosManager;
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

               $movimiento = new Movimiento();
//               $movimiento->user()->associate(Auth::user()); Pendiente para cuando este protegida la ruta

               $movimiento->user()->associate(User::all()->first());

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
                    /* Solo en caso que no sea trazable, puede existir deuda */
                    $insumo = DB::table('ticket_entrada_insumo_no_trazable')
                        ->where('id', '=', $ticket->id)
                        ->select('insumo_nt_id')
                        ->get()->first();

                    $idInsumo = $insumo->insumo_nt_id;

                    $cantRestante = PrestamosManager::registrarDevolucionInsumo(
                        $ticket->cliente_id, $idInsumo, $ticket->id, $ticket->neto
                    );

                    $cantRestante = $ticket->neto;

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
                    }
                    else {
                        // No registro movimiento, xq no le queda "cantidad restante"
                    }
                }
                else {
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
