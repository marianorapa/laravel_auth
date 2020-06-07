<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $prioridad_id
 * @property float $precio_por_tn
 * @property float $variacion_admitida
 * @property string $fecha_desde
 * @property string $fecha_hasta
 * @property string $created_at
 * @property string $updated_at
 * @property NivelPrioridad $nivelPrioridad
 */
class PrecioFason extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'precio_fason';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['prioridad_id', 'precio_por_tn', 'variacion_admitida', 'fecha_desde', 'fecha_hasta', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nivelPrioridad()
    {
        return $this->belongsTo('App\NivelPrioridad', 'prioridad_id');
    }
}
