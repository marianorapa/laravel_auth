<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $descripcion
 * @property string $created_at
 * @property string $updated_at
 * @property Movimiento[] $movimientos
 */
class TipoMovimiento extends Model
{
    const FINALIZACION_ENTRADA = 1;
//    const FINALIZACION_ENTRADA = 1;
//    const FINALIZACION_ENTRADA = 1;
//    const FINALIZACION_ENTRADA = 1;
//    const FINALIZACION_ENTRADA = 1;
//    const FINALIZACION_ENTRADA = 1;
//    const FINALIZACION_ENTRADA = 1;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tipo_movimiento';

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

    public static function getMovimiento(int $tipo)
    {
        return TipoMovimiento::find($tipo);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientos()
    {
        return $this->hasMany('App\Movimiento');
    }
}
