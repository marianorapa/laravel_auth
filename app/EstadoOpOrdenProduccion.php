<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $estado_id
 * @property integer $ord_pro_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property EstadoOrdPro $estadoOrdPro
 * @property OrdenDeProduccion $ordenDeProduccion
 * @property User $user
 */
class EstadoOpOrdenProduccion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'estado_op_orden_de_produccion';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['estado_id', 'ord_pro_id', 'user_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estadoOrdPro()
    {
        return $this->belongsTo('App\EstadoOrdPro', 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ordenDeProduccion()
    {
        return $this->belongsTo('App\OrdenDeProduccion', 'ord_pro_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
