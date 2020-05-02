<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketSalida extends Model
{
    //

    use SoftDeletes;

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
