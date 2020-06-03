<?php

use App\Permiso;
use Illuminate\Database\Seeder;

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
        $this->seed_permisos_balanzas();
        $this->seed_permisos_administracion();
        $this->seed_permisos_entrada();
        $this->seed_permisos_despacho();
        $this->seed_permisos_formulas();
        $this->seed_permisos_ordenProduccion();
        $this->seed_permisos_parametros();

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

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'users.roles.asignar';
        $permiso->descr = 'Asignar roles a usuario';
        $permiso->funcionalidad = 'Permite asignar roles a un usuario, incluso ROL ADMINISTRADOR';
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

    public function seed_permisos_balanzas(){
        $permiso = new Permiso();
        $permiso->nombre_ruta = 'balanzas.menu';
        $permiso->descr = 'Menu balanzas';
        $permiso->funcionalidad = 'Permite visualizar el menu del sector balanzas';
        $permiso->save();
    }

    public function seed_permisos_administracion(){
        $permiso = new Permiso();
        $permiso->nombre_ruta = 'administracion.menu';
        $permiso->descr = 'Menu administración';
        $permiso->funcionalidad = 'Permite visualizar el menu del sector administración';
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'administracion.stock';
        $permiso->descr = 'Menu administración de stock';
        $permiso->funcionalidad = 'Permite visualizar el menu de stock del sector administración';
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'administracion.stock.insumos';
        $permiso->descr = 'Menu administración de stock de insumos';
        $permiso->funcionalidad = 'Permite visualizar el menu de stock de insumos del sector administración';
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'administracion.stock.productos';
        $permiso->descr = 'Menu administración de stock de productos';
        $permiso->funcionalidad = 'Permite visualizar el menu de stock de productos del sector administración';
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'administracion.empresas';
        $permiso->descr = 'Menu administración de empresas';
        $permiso->funcionalidad = 'Permite visualizar el menu de administración de empresas';
        $permiso->save();
    }

    public function seed_permisos_entrada(){
        $permiso = new Permiso();
        $permiso->nombre_ruta = 'ingresos.index';
        $permiso->descr = 'Ver ingresos';
        $permiso->funcionalidad = 'Permite ver los ingresos registrados';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'balanzas.ingresos.inicial';
        $permiso->descr = 'Crear ingresos';
        $permiso->funcionalidad = 'Permite ver el formulario para crear nuevos ingresos';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'balanzas.ingresos.inicial.guardar';
        $permiso->descr = 'Guardar ingresos en proceso';
        $permiso->funcionalidad = 'Permite guardar nuevos ingresos en proceso';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'balanzas.ingresos.final';
        $permiso->descr = 'Formulario de finalizacion de ingreso';
        $permiso->funcionalidad = 'Permite ver el formulario para finalizar ingresos';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'balanzas.ingresos.final.guardar';
        $permiso->descr = 'Finalizar ingresos';
        $permiso->funcionalidad = 'Permite registrar ingresos finalizados';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'balanzas.ingresos.destroy';
        $permiso->descr = 'Eliminar ingresos en proceso';
        $permiso->funcionalidad = 'Permite eliminar ingresos en proceso de forma logica';
//        $permiso->activo = true;
        $permiso->save();
    }

    public function seed_permisos_despacho(){
        $permiso = new Permiso();
        $permiso->nombre_ruta = 'despachos.index';
        $permiso->descr = 'Ver despachos';
        $permiso->funcionalidad = 'Permite ver los despachos registrados';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'despachos.create';
        $permiso->descr = 'Crear despachos';
        $permiso->funcionalidad = 'Permite ver el formulario para crear nuevos despachos';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'despachos.store';
        $permiso->descr = 'Guardar despachos';
        $permiso->funcionalidad = 'Permite guardar nuevos despachos en proceso';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'despachos.finalize.view';
        $permiso->descr = 'Vista de finalización de despachos';
        $permiso->funcionalidad = 'Permite ver el formulario para finalizar despachos';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'despachos.finalize.post';
        $permiso->descr = 'Finalizar despachos';
        $permiso->funcionalidad = 'Permite finalizar despachos en proceso';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'despachos.destroy';
        $permiso->descr = 'Eliminar despachos en proceso';
        $permiso->funcionalidad = 'Permite eliminar despachos en proceso de forma lógica';
//        $permiso->activo = true;
        $permiso->save();
    }

    public function seed_permisos_formulas(){
        $permiso = new Permiso();
        $permiso->nombre_ruta = 'formula.index';
        $permiso->descr = 'Ver fórmulas registradas';
        $permiso->funcionalidad = 'Permite visualizar las fórmulas registradas';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'formula.create';
        $permiso->descr = 'Crear una fórmula';
        $permiso->funcionalidad = 'Permite crear una nueva fórmula';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'formula.store';
        $permiso->descr = 'Guardar una fórmula';
        $permiso->funcionalidad = 'Permite guardar una nueva fórmula';
//        $permiso->activo = true;
        $permiso->save();
    }

    public function seed_permisos_ordenProduccion(){
        $permiso = new Permiso();
        $permiso->nombre_ruta = 'pedidos.index';
        $permiso->descr = 'Ver pedidos';
        $permiso->funcionalidad = 'Permite ver los pedidos registrados';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'pedidos.create';
        $permiso->descr = 'Crear pedidos';
        $permiso->funcionalidad = 'Permite ver el formulario para crear nuevos pedidos';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'pedidos.store';
        $permiso->descr = 'Guardar pedidos';
        $permiso->funcionalidad = 'Permite guardar nuevos pedidos en proceso';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'pedidos.finalize';
        $permiso->descr = 'Finalizar pedidos';
        $permiso->funcionalidad = 'Permite finalizar pedidos en proceso';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'pedidos.cancel';
        $permiso->descr = 'Cancelar pedidos en proceso';
        $permiso->funcionalidad = 'Permite cancelar pedidos en proceso';
//        $permiso->activo = true;
        $permiso->save();
    }

    public function seed_permisos_parametros(){
        $permiso = new Permiso();
        $permiso->nombre_ruta = 'parametros.index';
        $permiso->descr = 'Ver menu de parametros';
        $permiso->funcionalidad = 'Permite ver el menu de gestión de parámetros';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'parametros.precio.index';
        $permiso->descr = 'Ver precios';
        $permiso->funcionalidad = 'Permite ver los parámetros de precio';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'parametros.precio.view';
        $permiso->descr = 'Ver parametros de precio';
        $permiso->funcionalidad = 'Permite ver los parámetros de precio';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'parametros.precio.post';
        $permiso->descr = 'Guardar parámetros de precio';
        $permiso->funcionalidad = 'Permite guardar los parámetros de precio';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'parametros.capacidad.index';
        $permiso->descr = 'Ver capacidades';
        $permiso->funcionalidad = 'Permite ver los parámetros de capacidad';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'parametros.capacidad.view';
        $permiso->descr = 'Ver parametros de capacidad';
        $permiso->funcionalidad = 'Permite ver los parámetros de capacidad';
//        $permiso->activo = true;
        $permiso->save();

        $permiso = new Permiso();
        $permiso->nombre_ruta = 'parametros.capacidad.post';
        $permiso->descr = 'Guardar parámetros de capacidad';
        $permiso->funcionalidad = 'Permite guardar los parámetros de capacidad';
//        $permiso->activo = true;
        $permiso->save();
    }

}
