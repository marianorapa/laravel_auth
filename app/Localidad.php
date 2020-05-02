<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $provincia_id
 * @property string $descripcion
 * @property int $codigo_postal
 * @property string $created_at
 * @property string $updated_at
 * @property Provincia $provincium
 * @property Domicilio[] $domicilios
 */
class Localidad extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'localidad';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['provincia_id', 'descripcion', 'codigo_postal', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provincia()
    {
        return $this->belongsTo('App\Provincia', 'provincia_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function domicilios()
    {
        return $this->hasMany('App\Domicilio');
    }
}
