<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property Insumo $insumo
 * @property MovimientoInsumoInsTra[] $movimientoInsumoInsTras
 * @property OpDetalleNoTrazable[] $opDetalleNoTrazables
 * @property TicketEntradaInsumoNoTrazable[] $ticketEntradaInsumoNoTrazables
 */
class InsumoNoTrazable extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'insumo_no_trazable';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insumo()
    {
        return $this->belongsTo('App\Insumo', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientoInsumoInsTras()
    {
        return $this->hasMany('App\MovimientoInsumoInsTra', 'insumo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opDetalleNoTrazables()
    {
        return $this->hasMany('App\OpDetalleNoTrazable', 'insumo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketEntradaInsumoNoTrazables()
    {
        return $this->hasMany('App\TicketEntradaInsumoNoTrazable', 'insumo_nt_id');
    }
}
