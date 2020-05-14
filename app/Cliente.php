<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property Empresa $empresa
 * @property Alimento[] $alimentos
 * @property CreditoCliente[] $creditoClientes
 * @property Granja[] $granjas
 * @property MovimientoInsumo[] $movimientoInsumos
 * @property OpDetalleNoTrazable[] $opDetalleNoTrazables
 * @property Ticket[] $tickets
 */
class Cliente extends Model//extends Empresa
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cliente';

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
    public function empresa()
    {
        return $this->belongsTo('App\Empresa', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alimentos()
    {
        return $this->hasMany('App\Alimento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function creditoClientes()
    {
        return $this->hasMany('App\CreditoCliente');
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
    public function movimientoInsumos()
    {
        return $this->hasMany('App\MovimientoInsumo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opDetalleNoTrazables()
    {
        return $this->hasMany('App\OpDetalleNoTrazable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function getClientesAsArray(){
        $clientes = Cliente::all();

        $clienteArray = [];

        foreach($clientes as $cliente){
            $clienteArray[$cliente->id] = $cliente->empresa()->first()->denominacion;

        }
        return $clienteArray;
    }
}
