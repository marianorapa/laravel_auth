<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $op_detalle_id
 * @property integer $cliente_id
 * @property integer $insumo_id
 * @property string $created_at
 * @property string $updated_at
 * @property Cliente $cliente
 * @property InsumoNoTrazable $insumoNoTrazable
 * @property OrdenDeProduccionDetalle $ordenDeProduccionDetalle
 * @property PrestamoCliente[] $prestamoClientes
 */
class OrdenProduccionDetalleNoTrazable extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'op_detalle_no_trazable';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['op_detalle_id', 'cliente_id', 'insumo_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insumoNoTrazable()
    {
        return $this->belongsTo('App\InsumoNoTrazable', 'insumo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ordenDeProduccionDetalle()
    {
        return $this->belongsTo('App\OrdenDeProduccionDetalle', 'op_detalle_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamoClientes()
    {
        return $this->hasMany('App\PrestamoCliente', 'op_detalle_id');
    }
}
