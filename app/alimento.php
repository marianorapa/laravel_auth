<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $tipo
 * @property integer $cliente_id
 * @property string $descripcion
 * @property string $gtin
 * @property string $created_at
 * @property string $updated_at
 * @property Cliente $cliente
 * @property AlimentoTipo $alimentoTipo
 * @property AlimentoFormula[] $alimentoFormulas
 * @property MovimientoProducto[] $movimientoProductos
 * @property OrdenDeProduccion[] $ordenDeProduccions
 */
class alimento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'alimento';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['tipo', 'cliente_id', 'descripcion', 'gtin', 'created_at', 'updated_at'];

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
    public function alimentoTipo()
    {
        return $this->belongsTo('App\AlimentoTipo', 'tipo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alimentoFormulas()
    {
        return $this->hasMany('App\AlimentoFormula');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientoProductos()
    {
        return $this->hasMany('App\MovimientoProducto', 'producto_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordenDeProduccions()
    {
        return $this->hasMany('App\OrdenDeProduccion', 'producto_id');
    }
}
