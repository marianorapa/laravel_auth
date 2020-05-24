<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $ord_pro_id
 * @property string $created_at
 * @property string $updated_at
 * @property MovimientoProducto $movimientoProducto
 * @property OrdenDeProduccion $ordenDeProduccion
 */
class MovimientoProductoOrdenProduccion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'movimiento_producto_ord_pro';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['ord_pro_id', 'created_at', 'updated_at'];

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
    public function ordenDeProduccion()
    {
        return $this->belongsTo('App\OrdenDeProduccion', 'ord_pro_id');
    }
}
