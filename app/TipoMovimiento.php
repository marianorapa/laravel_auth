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
    const CONSUMO_OP = 2;
    const FINALIZACION_OP = 3;
    const ANULACION_OP = 4;
    const DEVOLUCION_INSUMO = 5;
    const FINALIZACION_SALIDA = 6;
    const REINTEGRO_CANCELACION_PRESTAMO = 7;

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
