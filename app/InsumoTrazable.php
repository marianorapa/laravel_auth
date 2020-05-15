<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property Insumo $insumo
 * @property InsumoEspecifico[] $insumoEspecificos
 */
class InsumoTrazable extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'insumo_trazable';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insumo()
    {
        return $this->belongsTo('App\Insumo', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function insumosEspecificos()
    {
        return $this->hasMany('App\InsumoEspecifico');
    }
}
