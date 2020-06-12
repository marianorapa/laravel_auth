<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $gtin
 * @property integer $insumo_trazable_id
 * @property integer $proveedor_id
 * @property string $descripcion
 * @property string $created_at
 * @property string $updated_at
 * @property InsumoTrazable $insumoTrazable
 * @property Proveedor $proveedor
 * @property LoteInsumoEspecifico[] $loteInsumoEspecificos
 */
class InsumoEspecifico extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'insumo_especifico';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'gtin';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['insumo_trazable_id', 'proveedor_id', 'descripcion', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insumoTrazable()
    {
        return $this->belongsTo('App\InsumoTrazable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proveedor()
    {
        return $this->belongsTo('App\Proveedor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lotesInsumoEspecifico()
    {
        return $this->hasMany('App\LoteInsumoEspecifico', 'insumo_especifico', 'gtin');
    }

    public function scopeDescripcion($query, $descripcion){
        return $query->where('descripcion', 'like', "%$descripcion%");
    }
}
