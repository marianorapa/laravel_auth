<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Eloquent
 *
 * @property integer $id
 * @property integer $insumo_t_id
 * @property string $created_at
 * @property string $updated_at
 * @property TicketEntrada $ticketEntrada
 * @property LoteInsumoEspecifico $loteInsumoEspecifico
 */
class TicketEntradaInsumoTrazable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ticket_entrada_insumo_trazable';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['insumo_t_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketEntrada()
    {
        return $this->belongsTo('App\TicketEntrada', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loteInsumoEspecifico()
    {
        return $this->belongsTo('App\LoteInsumoEspecifico', 'insumo_t_id');
    }
}
