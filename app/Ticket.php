<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $cliente_id
 * @property integer $transportista_id
 * @property integer $chofer_id
 * @property integer $bruto
 * @property integer $tara
 * @property string $patente
 * @property int $neto
 * @property string $created_at
 * @property string $updated_at
 * @property Pesaje $pesajeBruto
 * @property Chofer $chofer
 * @property Cliente $cliente
 * @property Pesaje $pesajeTara
 * @property Transportistum $transportistum
 * @property EstadoTicketTicket[] $estadoTicketTickets
 * @property TicketEntrada $ticketEntrada
 * @property TicketSalida $ticketSalida
 */
class Ticket extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ticket';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['cliente_id', 'transportista_id', 'chofer_id', 'bruto', 'tara', 'patente', 'neto', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pesajeInicial()
    {
        return $this->belongsTo('App\Pesaje', 'bruto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chofer()
    {
        return $this->belongsTo('App\Chofer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pesajeFinal()
    {
        return $this->belongsTo('App\Pesaje', 'tara');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transportista()
    {
        return $this->belongsTo('App\Transportistum', 'transportista_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estadoTicketTickets()
    {
        return $this->hasMany('App\EstadoTicketTicket');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ticketEntrada()
    {
        return $this->hasOne('App\TicketEntrada', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ticketSalida()
    {
        return $this->hasOne('App\TicketSalida', 'id');
    }
}
