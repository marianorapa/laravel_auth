<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $opd_id
 * @property string $created_at
 * @property string $updated_at
 * @property MovimientoInsumo $movimientoInsumo
 * @property OrdenDeProduccionDetalle $ordenDeProduccionDetalle
 */
class MovimientoInsumoOrdenProduccionDetalle extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'movimiento_insumo_ord_pro_det';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['opd_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movimientoInsumo()
    {
        return $this->belongsTo('App\MovimientoInsumo', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ordenDeProduccionDetalle()
    {
        return $this->belongsTo('App\OrdenDeProduccionDetalle', 'opd_id');
    }
}
