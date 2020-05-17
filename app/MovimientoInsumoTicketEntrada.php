<?php

namespace App;

/**
 * @property integer $id
 * @property integer $ticket_id
 * @property string $created_at
 * @property string $updated_at
 * @property MovimientoInsumo $movimientoInsumo
 * @property TicketEntrada $ticketEntrada
 */
class MovimientoInsumoTicketEntrada extends MovimientoInsumo
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movimiento_insumo_tkte';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['ticket_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movimientoInsumo()
    {
        return $this->belongsTo('App\MovimientoInsumo', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketEntrada()
    {
        return $this->belongsTo('App\TicketEntrada', 'ticket_id');
    }
}
