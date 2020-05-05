<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'descr', 'email'
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
        return $this->belongsTo('App\Persona', 'id');
    }


    public function hasRole($roleName){
        foreach($this->Roles()->get() as $role){
            if (strtoupper($role->name) == strtoupper($roleName)){
                return true;
            }
        }
        return false;
    }

    public function hasPermiso($nombreRuta){
        $roles = $this->Roles()->get();
        foreach ($roles as $role){
            if ($role->hasPermiso($nombreRuta)){
                return true;
            }
        }
        return false;
    }
}
