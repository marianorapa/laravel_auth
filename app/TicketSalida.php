<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * @mixin Eloquent
 */
class TicketSalida extends Model
{
    //

//    use SoftDeletes;

    protected $table = "ticket_salida";


    public function ticket(){
        return $this->belongsTo('App/Ticket', 'id');
    }

    public function ordenProduccion(){
        return $this->hasOne('App/OrdenProduccion', 'op_id');
    }


    public function scopeCliente($query, $cliente){

        if($cliente){
            return $query->where('cliente', 'LIKE',"%$cliente%"); //esta query devuelve semejanzas.
        }
    }

    public function scopePatente($query, $patente){

        if($patente){
            return $query->where('patente', 'LIKE',"%$patente%"); //esta query devuelve semejanzas.
        }
    }
}
