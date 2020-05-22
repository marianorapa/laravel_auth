<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $prestamo_id
 * @property integer $ticket_entrada_id
 * @property int $cantidad
 * @property string $created_at
 * @property string $updated_at
 * @property PrestamoCliente $prestamoCliente
 * @property TicketEntradaInsumoNoTrazable $ticketEntradaInsumoNoTrazable
 */
class PrestamoDevolucion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'prestamo_devoluciones';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['prestamo_id', 'ticket_entrada_id', 'cantidad', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestamoCliente()
    {
        return $this->belongsTo('App\PrestamoCliente', 'prestamo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketEntradaInsumoNoTrazable()
    {
        return $this->belongsTo('App\TicketEntradaInsumoNoTrazable', 'ticket_entrada_id');
    }
}
