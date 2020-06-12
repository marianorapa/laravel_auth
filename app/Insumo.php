<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $descripcion
 * @property string $created_at
 * @property string $updated_at
 * @property FormulaComposicion[] $formulaComposicions
 * @property InsumoNoTrazable $insumoNoTrazable
 * @property InsumoTrazable $insumoTrazable
 */
class Insumo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'insumo';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['descripcion', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function formulaComposicions()
    {
        return $this->hasMany('App\FormulaComposicion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function insumoNoTrazable()
    {
        return $this->hasOne('App\InsumoNoTrazable', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function insumoTrazable()
    {
        return $this->hasOne('App\InsumoTrazable', 'id');
    }
    public function getinsumo(){
        $insumos = Insumo::all();
        $insumoArray[0]="asdsa";
        foreach($insumos as $insumo){
            $insumoArray[$insumo->id] = $insumo->descripcion;
        }
        return $insumoArray;
    }

    public function scopeDescripcion($query, $descripcion){
        return $query->where('descripcion', 'like', "%$descripcion%");
    }
}
