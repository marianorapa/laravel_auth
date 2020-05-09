<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $localidad_id
 * @property string $calle
 * @property int $numero
 * @property string $piso
 * @property string $dpto
 * @property string $created_at
 * @property string $updated_at
 * @property Localidad $localidad
 * @property Granja[] $granjas
 * @property PersonaTipo[] $personaTipos
 */
class Domicilio extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'domicilio';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['localidad_id', 'calle', 'numero', 'piso', 'dpto', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function localidad()
    {
        return $this->belongsTo('App\Localidad');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function granjas()
    {
        return $this->hasMany('App\Granja');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function personaTipos()
    {
        return $this->hasMany('App\PersonaTipo');
    }

    public function toString(){
        return "$this->calle $this->numero, " . $this->localidad()->first()->toString();
    }
}
