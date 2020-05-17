<?php

namespace App;

/**
 * @property integer $id
 * @property integer $cliente_id
 * @property int $cantidad
 * @property string $created_at
 * @property string $updated_at
 * @property Cliente $cliente
 * @property Movimiento $movimiento
 * @property MovimientoInsumoInsNoTra $movimientoInsumoInsNoTra
 * @property MovimientoInsumoInsTra $movimientoInsumoInsTra
 * @property MovimientoInsumoOrdProDet $movimientoInsumoOrdProDet
 * @property MovimientoInsumoTkte $movimientoInsumoTkte
 */
class MovimientoInsumo extends Movimiento
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movimiento_insumo';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['cliente_id', 'cantidad', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movimiento()
    {
        return $this->belongsTo('App\Movimiento', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function movimientoInsumoInsNoTra()
    {
        return $this->hasOne('App\MovimientoInsumoInsNoTra', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function movimientoInsumoInsTra()
    {
        return $this->hasOne('App\MovimientoInsumoInsTra', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function movimientoInsumoOrdProDet()
    {
        return $this->hasOne('App\MovimientoInsumoOrdProDet', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function movimientoInsumoTkte()
    {
        return $this->hasOne('App\MovimientoInsumoTkte', 'id');
    }
}
