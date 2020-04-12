<?php

namespace App;
use App\Role;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use SoftDeletes;

    //
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
