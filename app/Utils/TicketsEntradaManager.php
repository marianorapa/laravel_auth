<?php


namespace App\Utils;


use App\Cliente;
use App\Pesaje;
use App\Ticket;
use App\TicketEntrada;
use App\Transportista;

class TicketsEntradaManager
{

    public static function registrarTicketEntrada($idCliente, $idTransportista, $patente,
                                                  $nroCbte, $pesaje): TicketEntrada
    {
        $ticketEntrada = new TicketEntrada();

        $ticket = new Ticket();

        $ticket->cliente()->associate(Cliente::findOrFail($idCliente));
        $ticket->transportista()->associate(Transportista::findOrFail($idTransportista));
        $ticket->patente = $patente;

        $pesajeInicial = new Pesaje();
        $pesajeInicial->peso = $pesaje;
        $pesajeInicial->save();

        $ticket->bruto()->associate($pesajeInicial);

        $ticket->save();

        $ticketEntrada->ticket()->associate($ticket);
        $ticketEntrada->cbte_asociado = $nroCbte;
        $ticketEntrada->save();

        return $ticketEntrada;
    }

    public static function finalizarTicket($id, $tara)
    {
        $ticketEntrada = TicketEntrada::findOrFail($id);

        $pesaje = new Pesaje();
        $pesaje->peso = $tara;
        $pesaje->save();

        $ticketEntrada->ticket()->first()->tara()->associate($pesaje);

        echo "<pre>";
        print_r($ticketEntrada->ticket()->first());exit(0);

        $ticketEntrada->save();
    }

}
