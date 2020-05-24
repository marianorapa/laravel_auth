<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $tkt_sal_id
 * @property string $created_at
 * @property string $updated_at
 * @property MovimientoProducto $movimientoProducto
 * @property TicketSalida $ticketSalida
 */
class MovimientoProductoTicketSalida extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'movimiento_producto_tkt_sal';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['tkt_sal_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movimientoProducto()
    {
        return $this->belongsTo('App\MovimientoProducto', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketSalida()
    {
        return $this->belongsTo('App\TicketSalida', 'tkt_sal_id');
    }
}
