<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Persona;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = new User();
        // $user->username = 'Admin';
        // $user->password = '1234';        
        // $user->persona()->save(Persona::find(1));
        // // Asignamos el rol administrador
        // $user->roles()->attach(Role::where('name','admin')->first());
        // $user->save();


        // $user = new User();
        // $user->username = 'User';
        // $user->password = '1234';
        // $user->persona()->save(Persona::find(2));
        // // Asignamos el rol usuario comun
        // $user->roles()->attach(Role::where('name','user')->first());
        // $user->save();
    }
}
