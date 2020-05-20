<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $alimento_id
 * @property string $fecha_desde
 * @property string $fecha_hasta
 * @property string $created_at
 * @property string $updated_at
 * @property Alimento $alimento
 * @property FormulaComposicion[] $formulaComposicions
 */
class AlimentoFormula extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'alimento_formula';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['alimento_id', 'fecha_desde', 'fecha_hasta', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alimento()
    {
        return $this->belongsTo('App\Alimento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function formulaComposicions()
    {
        return $this->hasMany('App\FormulaComposicion', 'formula_id');
    }
}
