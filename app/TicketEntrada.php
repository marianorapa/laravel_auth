<?php

namespace App;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 *
 * @property integer $id
 * @property string $cbte_asociado
 * @property string $created_at
 * @property string $updated_at
 * @property Ticket $ticket
 * @property MovimientoInsumoTkte[] $movimientoInsumoTktes
 * @property TicketEntradaInsumoNoTrazable $ticketEntradaInsumoNoTrazable
 * @property TicketEntradaInsumoTrazable $ticketEntradaInsumoTrazable
 */
class TicketEntrada extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ticket_entrada';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['cbte_asociado', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo('App\Ticket', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientoInsumoTktes()
    {
        return $this->hasMany('App\MovimientoInsumoTkte', 'ticket_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ticketEntradaInsumoNoTrazable()
    {
        return $this->hasOne('App\TicketEntradaInsumoNoTrazable', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ticketEntradaInsumoTrazable()
    {
        return $this->hasOne('App\TicketEntradaInsumoTrazable', 'id');
    }
}
