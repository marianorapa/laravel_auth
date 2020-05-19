<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $op_id
 * @property int $cantidad
 * @property string $created_at
 * @property string $updated_at
 * @property OrdenDeProduccion $ordenDeProduccion
 * @property MovimientoInsumoOrdProDet[] $movimientoInsumoOrdProDets
 * @property OpDetalleNoTrazable[] $opDetalleNoTrazables
 * @property OpDetalleTrazable[] $opDetalleTrazables
 */
class OrdenProduccionDetalle extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'orden_de_produccion_detalle';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['op_id', 'cantidad', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ordenDeProduccion()
    {
        return $this->belongsTo('App\OrdenDeProduccion', 'op_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientoInsumoOrdProDets()
    {
        return $this->hasMany('App\MovimientoInsumoOrdProDet', 'opd_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opDetalleNoTrazables()
    {
        return $this->hasMany('App\OpDetalleNoTrazable', 'op_detalle_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opDetalleTrazables()
    {
        return $this->hasMany('App\OpDetalleTrazable', 'op_detalle_id');
    }
}
