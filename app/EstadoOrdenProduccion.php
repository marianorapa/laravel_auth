<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $descripcion
 * @property string $created_at
 * @property string $updated_at
 * @property EstadoOpOrdenDeProduccion[] $estadoOpOrdenDeProduccions
 */
class EstadoOrdenProduccion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'estado_ord_pro';

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

    public static function getEstadoPendiente()
    {
        return EstadoOrdenProduccion::find(1);
    }

    public static function getEstadoFinalizada()
    {
        return EstadoOrdenProduccion::find(3);
    }

    public static function getEstadoAnulada()
    {
        return EstadoOrdenProduccion::find(2);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estadoOpOrdenDeProduccions()
    {
        return $this->hasMany('App\EstadoOpOrdenDeProduccion', 'estado_id');
    }
}
