<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'descr', 'email', 'activo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
    ];
    //'remember_token', saco de hidden para probar

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];


    public function Roles(){
        return $this->belongsToMany(Role::class);
    }

    public function Persona(){
        return $this->belongsTo(Persona::class);
    }


    public function is($roleName){
        foreach($this->Roles()->get() as $role){
            if (strtoupper($role->nombre) == strtoupper($roleName)){
                return true;
            }
        }
        return false;
    }

}
