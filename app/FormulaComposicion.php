<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $formula_id
 * @property integer $insumo_id
 * @property integer $kilos_por_tonelada
 * @property string $created_at
 * @property string $updated_at
 * @property AlimentoFormula $alimentoFormula
 * @property Insumo $insumo
 */
class FormulaComposicion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'formula_composicion';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['formula_id', 'insumo_id', 'kilos_por_tonelada', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alimentoFormula()
    {
        return $this->belongsTo('App\AlimentoFormula', 'formula_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insumo()
    {
        return $this->belongsTo('App\Insumo');
    }
}
