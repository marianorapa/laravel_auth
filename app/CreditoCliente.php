<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $cliente_id
 * @property int $limite
 * @property string $fecha_desde
 * @property string $fecha_hasta
 * @property string $created_at
 * @property string $updated_at
 * @property Cliente $cliente
 */
class CreditoCliente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'credito_cliente';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['cliente_id', 'limite', 'fecha_desde', 'fecha_hasta', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
}
