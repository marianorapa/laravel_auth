<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $tipo_movimiento_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property TipoMovimiento $tipoMovimiento
 * @property User $user
 * @property MovimientoInsumo $movimientoInsumo
 * @property MovimientoProducto $movimientoProducto
 */
class Movimiento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'movimiento';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['tipo_movimiento_id', 'user_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoMovimiento()
    {
        return $this->belongsTo('App\TipoMovimiento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function movimientoInsumo()
    {
        return $this->hasOne('App\MovimientoInsumo', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function movimientoProducto()
    {
        return $this->hasOne('App\MovimientoProducto', 'id');
    }
}
