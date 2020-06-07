<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $descripcion
 * @property string $created_at
 * @property string $updated_at
 * @property Alimento[] $alimentos
 */
class alimentoTipo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alimento_tipo';

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
    public function alimentos()
    {
        return $this->hasMany('App\Alimento', 'tipo');
    }

    public function getAlimentoTipo(){
        $aliementoTipo = alimentoTipo::all();
        foreach($aliementoTipo as $tipo){
            $tipoArray[$tipo->id] = $tipo->descripcion;
        }
        return $tipoArray;
    }
}
