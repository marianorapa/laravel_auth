<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $insumo_especifico
 * @property int $nro_lote
 * @property string $fecha_elaboracion
 * @property string $fecha_vencimiento
 * @property string $created_at
 * @property string $updated_at
 * @property InsumoEspecifico $insumoEspecifico
 * @property MovimientoInsumoInsNoTra[] $movimientoInsumoInsNoTras
 * @property OpDetalleTrazable[] $opDetalleTrazables
 * @property TicketEntradaInsumoTrazable[] $ticketEntradaInsumoTrazables
 */
class LoteInsumoEspecifico extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'lote_insumo_especifico';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['insumo_especifico', 'nro_lote', 'fecha_elaboracion', 'fecha_vencimiento', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insumoEspecifico()
    {
        return $this->belongsTo('App\InsumoEspecifico', 'insumo_especifico', 'gtin');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientoInsumoInsNoTras()
    {
        return $this->hasMany('App\MovimientoInsumoInsNoTra', 'insumo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opDetalleTrazables()
    {
        return $this->hasMany('App\OpDetalleTrazable', 'lote_insumo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketEntradaInsumoTrazables()
    {
        return $this->hasMany('App\TicketEntradaInsumoTrazable', 'insumo_t_id');
    }
}
