<?php

namespace App;
use App\Permiso;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{

    use SoftDeletes;

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function permisos(){
        return $this->belongsToMany(Permiso::class)->withTimestamps();
    }

    public function hasPermiso($nombreRuta){
        $permisos = $this->permisos()->get();
        foreach ($permisos as $permiso){
            if ($permiso->nombre_ruta == $nombreRuta){
                return true;
            }
        }
        return false;
    }

    public function scopeName($query, $name){ //FILTRO POR NOMBRE

        if($name){
            return $query->where('name', 'LIKE',"%$name%"); //esta query devuelve semejanzas.
        }
    }

    public function scopeDescr($query, $descr){ //FILTRO POR DESCRIPCION

        if($descr){
            return $query->where('descr', 'LIKE',"%$descr%"); //esta query devuelve semejanzas.
        }
    }
}
