<?php

use Illuminate\Database\Seeder;
use App\Permiso;

class PermisoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permiso = new Permiso();
        $permiso->name = 'Alta usuario';
        $permiso->descr = 'Dar de alta un usuario en el sistema';
        $permiso->funcionalidad = 'Permite agregar nuevos usuarios al sistema';
        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->name = 'Alta permiso';
        $permiso->descr = 'Dar de alta un permiso en el sistema';
        $permiso->funcionalidad = 'Permite agregar nuevos permisos al sistema';
        $permiso->activo = true;
        $permiso->save();
        
        $permiso = new Permiso();
        $permiso->name = 'Alta rol';
        $permiso->descr = 'Dar de alta un rol en el sistema';
        $permiso->funcionalidad = 'Permite agregar nuevos roles al sistema';
        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->name = 'Ver menu usuario';
        $permiso->descr = 'Ver el menu del usuario no admin';
        $permiso->funcionalidad = 'Permite visualizar el menu de usuarios del sistema';
        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->name = 'Ver menu admin';
        $permiso->descr = 'Ver el menu del administrador';
        $permiso->funcionalidad = 'Permite visualizar el menu de administrador del sistema';
        $permiso->activo = true;
        $permiso->save();
    }
}
