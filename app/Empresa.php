<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $denominacion
 * @property string $fecha_inicio_actividades
 * @property string $created_at
 * @property string $updated_at
 * @property PersonaTipo $personaTipo
 * @property Cliente $cliente
 * @property Proveedor $proveedor
 * @property Transportistum $transportistum
 */
class Empresa extends PersonaTipo
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'empresa';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['denominacion', 'fecha_inicio_actividades'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personaTipo()
    {
        return $this->belongsTo('App\PersonaTipo', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Cliente', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proveedor()
    {
        return $this->hasOne('App\Proveedor', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transportistum()
    {
        return $this->hasOne('App\Transportistum', 'id');
    }
}
