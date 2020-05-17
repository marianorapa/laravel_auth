<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $insumo_id
 * @property string $created_at
 * @property string $updated_at
 * @property MovimientoInsumo $movimientoInsumo
 * @property InsumoNoTrazable $insumoNoTrazable
 */
class MovimientoInsumoNoTrazable extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'movimiento_insumo_ins_no_tra';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['insumo_id', 'created_at', 'updated_at'];

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
    public function insumoNoTrazable()
    {
        return $this->belongsTo('App\InsumoNoTrazable', 'insumo_id');
    }
}
