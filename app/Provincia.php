<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $descripcion
 * @property string $created_at
 * @property string $updated_at
 * @property Localidad[] $localidads
 */
class Provincia extends Model
{

    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'provincia';

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
    public function localidads()
    {
        return $this->hasMany('App\Localidad', 'provincia_id');
    }

    public function scopeBuscar($query, $name){
        if($name){
            return $query->where('nombres', 'LIKE',"%$name%"); //esta query devuelve semejanzas.
        }
    }

    public function getprovincia(){
        $provincias = Provincia::all();
        foreach($provincias as $provincia){
            $provinciaArray[$provincia->id] = $provincia->descripcion;
        }
        return $provinciaArray;
    }
}
