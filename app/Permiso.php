<?php

namespace App;
use App\Role;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use SoftDeletes;


    protected $fillable = ['nombre_ruta', 'descr', 'funcionalidad'];


    //
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function scopeNruta($query, $nombreruta){ //FILTRO POR DESCRIPCION

        if($nombreruta){
            return $query->where('nombre_ruta', 'LIKE',"%$nombreruta%"); //esta query devuelve semejanzas.
        }
    }

    public function scopeDescr($query, $descr){ //FILTRO POR DESCRIPCION

        if($descr){
            return $query->where('descr', 'LIKE',"%$descr%"); //esta query devuelve semejanzas.
        }
    }
}
