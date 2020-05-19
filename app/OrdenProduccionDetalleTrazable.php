<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $op_detalle_id
 * @property integer $lote_insumo_id
 * @property string $created_at
 * @property string $updated_at
 * @property LoteInsumoEspecifico $loteInsumoEspecifico
 * @property OrdenDeProduccionDetalle $ordenDeProduccionDetalle
 */
class OrdenProduccionDetalleTrazable extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'op_detalle_trazable';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['op_detalle_id', 'lote_insumo_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loteInsumoEspecifico()
    {
        return $this->belongsTo('App\LoteInsumoEspecifico', 'lote_insumo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ordenDeProduccionDetalle()
    {
        return $this->belongsTo('App\OrdenDeProduccionDetalle', 'op_detalle_id');
    }
}
