<?php

namespace App;
use App\Permiso;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function permisos(){
        return $this->belongsToMany(Permiso::class)->withTimestamps();
    }
}