<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $insumo_nt_id
 * @property integer $proveedor_id
 * @property string $created_at
 * @property string $updated_at
 * @property TicketEntrada $ticketEntrada
 * @property InsumoNoTrazable $insumoNoTrazable
 * @property Proveedor $proveedor
 * @property PrestamoDevolucione[] $prestamoDevoluciones
 */
class TicketEntradaInsumoNoTrazable extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ticket_entrada_insumo_no_trazable';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['insumo_nt_id', 'proveedor_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticketEntrada()
    {
        return $this->belongsTo('App\TicketEntrada', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insumoNoTrazable()
    {
        return $this->belongsTo('App\InsumoNoTrazable', 'insumo_nt_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proveedor()
    {
        return $this->belongsTo('App\Proveedor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamoDevoluciones()
    {
        return $this->hasMany('App\PrestamoDevolucione', 'ticket_entrada_id');
    }
}
