<?php

use App\Permiso;
use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->descr = 'Administrator';
        $role->activo = true;
        //$role->permisos()->attach(Permiso::all()->first());
        $role->save();
       

        $role = new Role();
        $role->name = 'user';
        $role->descr = 'Usuario no administrador';
        $role->activo = true;
        //$role->permisos()->attach(Permiso::where('name','Ver menu usuario')->first());
        $role->save();
    }
}
