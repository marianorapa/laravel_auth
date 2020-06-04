<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 *
 * @property integer $id
 * @property integer $producto_id
 * @property integer $destino
 * @property int $cantidad
 * @property int $saldo
 * @property string $fecha_fabricacion
 * @property float $precio_venta_por_tn
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $anulada
 * @property Granja $granja
 * @property Alimento $alimento
 * @property EstadoOpOrdenDeProduccion[] $estadoOpOrdenDeProduccions
 * @property MovimientoCapacidadProductiva[] $movimientoCapacidadProductivas
 * @property MovimientoProductoOrdPro[] $movimientoProductoOrdPros
 * @property OrdenDeProduccionDetalle[] $ordenDeProduccionDetalles
 * @property TicketSalida[] $ticketSalidas
 */
class OrdenProduccion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orden_de_produccion';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['producto_id', 'destino', 'cantidad', 'saldo', 'fecha_fabricacion', 'precio_venta_por_kilo', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function granja()
    {
        return $this->belongsTo('App\Granja', 'destino');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alimento()
    {
        return $this->belongsTo('App\Alimento', 'producto_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estadoOpOrdenDeProduccions()
    {
        return $this->hasMany('App\EstadoOpOrdenProduccion', 'ord_pro_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientoCapacidadProductivas()
    {
        return $this->hasMany('App\MovimientoCapacidadProductiva', 'ord_pro_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientoProductoOrdPros()
    {
        return $this->hasMany('App\MovimientoProductoOrdPro', 'ord_pro_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordenDeProduccionDetalles()
    {
        return $this->hasMany('App\OrdenProduccionDetalle', 'op_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketSalidas()
    {
        return $this->hasMany('App\TicketSalida', 'op_id');
    }

    public function isPendiente() : bool {
        $estado = $this->estadoOpOrdenDeProduccions()
            ->orderByDesc('created_at')->get()->first();

        return $estado->estado_id == EstadoOrdenProduccion::getEstadoPendiente()->id;
    }

    public function anularOrden() {
        $estadoOp = new EstadoOpOrdenProduccion();
        $estadoOp->ord_pro_id = $this->id;
        $estadoOp->estado_id = EstadoOrdenProduccion::getEstadoAnulada()->id;
//        $estadoOp->user()->associate(Auth::user());
        $estadoOp->user()->associate(User::all()->first());
        $this->anulada = true;
        $this->save();
        $estadoOp->save();
    }
}
