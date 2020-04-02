<?php

use Illuminate\Database\Seeder;

use App\Role;
use App\Permiso;


class RolePermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $role = Role::find(1);

       $role->permisos()->attach(Permiso::all());
       
       $role->save();


       $role = Role::find(2);
        $role->permisos()->attach(Permiso::find(4));

    }
}
