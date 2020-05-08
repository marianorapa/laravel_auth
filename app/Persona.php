<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['apellidos','nombres', 'fecha_nacimiento'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personaTipo()
    {
        return $this->belongsTo('App\PersonaTipo', 'id');

    }


    public function scopeName($query, $name){

        if($name){
            return $query->where('nombres', 'LIKE',"%$name%"); //esta query devuelve semejanzas.
        }
    }

    public function scopeNrodoc($query, $nrodocumento){

        if($nrodocumento){
            return $query->where('nroDocumento', 'LIKE',"%$nrodocumento%"); //esta query devuelve semejanzas.
        }
    }

    public function scopeApellido($query, $apellidos){

        if($apellidos){
            return $query->where('apellidos', 'LIKE',"%$apellidos%"); //esta query devuelve semejanzas.
        }
    }

    public function user(){
        return $this->hasOne(User::class);
    }


}
