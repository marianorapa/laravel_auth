<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $estado_id
 * @property integer $ticket_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property EstadoTicket $estadoTicket
 * @property Ticket $ticket
 * @property User $user
 */
class EstadoTicketTicket extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'estado_ticket_ticket';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['estado_id', 'ticket_id', 'user_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estadoTicket()
    {
        return $this->belongsTo('App\EstadoTicket', 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
