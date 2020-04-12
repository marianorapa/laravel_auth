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
        $this->seed_permisos_menus();
        $this->seed_permisos_users();
        $this->seed_permisos_personas();
        $this->seed_permisos_permisos();
        $this->seed_permisos_roles();
    }

    public function seed_permisos_users(): void
    {
        $permiso = new Permiso();
        $permiso->nombre_ruta = 'users.index';
        $permiso->descr = 'Ver usuarios';
        $permiso->funcionalidad = 'Permite ver los usuarios registrados';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'users.create';
        $permiso->descr = 'Crear usuarios';
        $permiso->funcionalidad = 'Permite ver el formulario para crear nuevos usuarios';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'users.store';
        $permiso->descr = 'Guardar usuarios';
        $permiso->funcionalidad = 'Permite guardar nuevos usuarios';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'users.edit';
        $permiso->descr = 'Editar usuarios';
        $permiso->funcionalidad = 'Permite ver el formulario para editar usuarios';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'users.update';
        $permiso->descr = 'Actualizar usuarios';
        $permiso->funcionalidad = 'Permite actualizar usuarios existentes';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'users.destroy';
        $permiso->descr = 'Eliminar usuarios';
        $permiso->funcionalidad = 'Permite eliminar usuarios de forma logica';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'users.activate';
        $permiso->descr = 'Activar usuarios';
        $permiso->funcionalidad = 'Permite activar usuarios eliminados';
//        $permiso->activo = true;
        $permiso->save();
    }

    private function seed_permisos_menus()
    {
        $permiso = new Permiso();
        $permiso->nombre_ruta = 'admin.menu';
        $permiso->descr = 'Ver menu administrador';
        $permiso->funcionalidad = 'Permite ver el menu de administrador';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'main';
        $permiso->descr = 'Ver menu principal';
        $permiso->funcionalidad = 'Permite ver el menu principal';
//        $permiso->activo = true;
        $permiso->save();
    }

    private function seed_permisos_personas()
    {
        $permiso = new Permiso();
        $permiso->nombre_ruta = 'personas.index';
        $permiso->descr = 'Ver personas';
        $permiso->funcionalidad = 'Permite ver las personas registradas';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'personas.create';
        $permiso->descr = 'Crear personas';
        $permiso->funcionalidad = 'Permite ver el formulario para crear nuevas personas';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'personas.store';
        $permiso->descr = 'Guardar personas';
        $permiso->funcionalidad = 'Permite guardar nuevas personas';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'personas.edit';
        $permiso->descr = 'Editar personas';
        $permiso->funcionalidad = 'Permite ver el formulario para editar personas';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'personas.update';
        $permiso->descr = 'Actualizar personas';
        $permiso->funcionalidad = 'Permite actualizar personas existentes';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'personas.destroy';
        $permiso->descr = 'Eliminar personas';
        $permiso->funcionalidad = 'Permite eliminar personas de forma logica';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'personas.activate';
        $permiso->descr = 'Activar personas';
        $permiso->funcionalidad = 'Permite activar personas eliminadas';
//        $permiso->activo = true;
        $permiso->save();
    }

    private function seed_permisos_permisos()
    {
        $permiso = new Permiso();
        $permiso->nombre_ruta = 'permisos.index';
        $permiso->descr = 'Ver permisos';
        $permiso->funcionalidad = 'Permite ver los permisos registrados';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'permisos.create';
        $permiso->descr = 'Crear permisos';
        $permiso->funcionalidad = 'Permite ver el formulario para crear nuevos permisos';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'permisos.store';
        $permiso->descr = 'Guardar permisos';
        $permiso->funcionalidad = 'Permite guardar nuevos permisos';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'permisos.edit';
        $permiso->descr = 'Editar permisos';
        $permiso->funcionalidad = 'Permite ver el formulario para editar permisos';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'permisos.update';
        $permiso->descr = 'Actualizar permisos';
        $permiso->funcionalidad = 'Permite actualizar permisos existentes';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'permisos.destroy';
        $permiso->descr = 'Eliminar permisos';
        $permiso->funcionalidad = 'Permite eliminar permisos de forma logica';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'permisos.activate';
        $permiso->descr = 'Activar permisos';
        $permiso->funcionalidad = 'Permite activar permisos eliminados';
//        $permiso->activo = true;
        $permiso->save();
    }

    private function seed_permisos_roles()
    {
        $permiso = new Permiso();
        $permiso->nombre_ruta = 'roles.index';
        $permiso->descr = 'Ver roles';
        $permiso->funcionalidad = 'Permite ver los roles registrados';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'roles.create';
        $permiso->descr = 'Crear roles';
        $permiso->funcionalidad = 'Permite ver el formulario para crear nuevos roles';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'roles.store';
        $permiso->descr = 'Guardar roles';
        $permiso->funcionalidad = 'Permite guardar nuevos roles';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'roles.edit';
        $permiso->descr = 'Editar roles';
        $permiso->funcionalidad = 'Permite ver el formulario para editar roles';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'roles.update';
        $permiso->descr = 'Actualizar roles';
        $permiso->funcionalidad = 'Permite actualizar roles existentes';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'roles.destroy';
        $permiso->descr = 'Eliminar roles';
        $permiso->funcionalidad = 'Permite eliminar roles de forma logica';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'roles.activate';
        $permiso->descr = 'Activar roles';
        $permiso->funcionalidad = 'Permite activar roles eliminados';
//        $permiso->activo = true;
        $permiso->save();
    }
}
