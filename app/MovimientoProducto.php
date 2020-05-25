<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $producto_id
 * @property int $cantidad
 * @property string $created_at
 * @property string $updated_at
 * @property Movimiento $movimiento
 * @property Alimento $alimento
 * @property MovimientoProductoOrdPro $movimientoProductoOrdPro
 * @property MovimientoProductoTktSal $movimientoProductoTktSal
 */
class MovimientoProducto extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movimiento_producto';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['producto_id', 'cantidad', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movimiento()
    {
        return $this->belongsTo('App\Movimiento', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alimento()
    {
        return $this->belongsTo('App\Alimento', 'producto_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function movimientoProductoOrdPro()
    {
        return $this->hasOne('App\MovimientoProductoOrdenProduccion', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function movimientoProductoTktSal()
    {
        return $this->hasOne('App\MovimientoProductoTktSal', 'id');
    }
}
