<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $descripcion
 * @property string $created_at
 * @property string $updated_at
 * @property EstadoTicketTicket[] $estadoTicketTickets
 */
class EstadoTicket extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'estado_ticket';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['descripcion', 'created_at', 'updated_at'];

    public static function getEstadoEnProceso()
    {
        return EstadoTicket::find(1);
    }

    public static function getEstadoAnulado()
    {
        return EstadoTicket::find(2);
    }

    public static function getEstadoFinalizado()
    {
        return EstadoTicket::find(3);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estadoTicketTickets()
    {
        return $this->hasMany('App\EstadoTicketTicket', 'estado_id');
    }
}
