<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $op_detalle_id
 * @property int $cancelado
 * @property string $created_at
 * @property string $updated_at
 * @property OpDetalleNoTrazable $opDetalleNoTrazable
 * @property PrestamoDevolucione[] $prestamoDevoluciones
 */
class PrestamoCliente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'prestamo_cliente';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['op_detalle_id', 'cancelado', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function opDetalleNoTrazable()
    {
        return $this->belongsTo('App\OpDetalleNoTrazable', 'op_detalle_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamoDevoluciones()
    {
        return $this->hasMany('App\PrestamoDevolucione', 'prestamo_id');
    }
}
