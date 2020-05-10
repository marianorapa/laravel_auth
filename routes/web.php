<?php

use Illuminate\Support\Facades\Route;

/*
 * Rutas de autenticación
 */
Route::get('/', function() {
    return view('welcome');
});

Route::get('/register', 'Auth\RegisterController@getRegisterUser')->name('register');
Route::post('/register', 'Auth\RegisterController@RegisterUser')->middleware('checkUserExistence');

    //Route::get('/register', 'Auth\RegisterController@CheckUserExistence');

Route::get('/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/login', 'Auth\LoginController@authenticate')->name('login');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

//Auth::routes()->middleware('checkUserExistence');

/*
 * Rutas protegidas
 */
Route::get('/main', 'HomeController@index')->name('main');

Route::get('/admin', 'AdminController@index')->name('admin.menu');

Route::resource('users', 'UserController');

Route::get('users/activate/{id}', 'UserController@activate')->name('users.activate');
Route::get('personas/activate/{id}', 'PersonaController@activate')->name('personas.activate');
Route::get('permisos/activate/{id}', 'PermisoController@activate')->name('permisos.activate');
Route::get('roles/activate/{id}','RoleController@activate')->name('roles.activate');

Route::resource('roles', 'RoleController');
Route::resource('permisos', 'PermisoController');
Route::resource('personas', 'PersonaController');

Route::get('balanzas', 'BalanzaController@index')->name('balanzas.menu');

Route::resource('ingresos', 'EntradaController');
Route::resource('despachos', 'DespachoController');

Route::get('/registroinsumoini', 'EntradaController@registroInsumoInicial')
    ->name('balanzas.ingresos.inicial');

Route::get('/registroinsumofinal', 'EntradaController@registroInsumoFinal')
    ->name('balanzas.ingresos.final');
/*
 * TODO: Rutas de usuario balanza/administración
 */

// GUARDA ACA!!! PORQUE EL USERCONTROLLER GESTIONA USUARIOS, NO NOT_ADMIN! <---
Route::get('/usuario', 'NoAdminController@index')->name('not.admin');

// Rutas de errores
Route::get('/error/not_allowed', 'ErrorController@notAllowed')->name('error.not_permission');



//ruta para ina funcion
route::get('/localidades', 'LocalidadController@getLocalidad'); //cambiar a un controlador o ponerlo en el controlador de persona.


//definir precio x kg
Route::get('/precioXkg', function() {
    return view('/parametrosProductivos/precioXkg');
})->name('pp.precio');

//gestion parametros productivos
Route::get('/gestionParametrosProductivos', function() {
    return view('/parametrosProductivos/gestionParametrosProductivos');
});

//definir capacidad productiva
Route::get('/capacidadProductiva', function() {
    return view('/parametrosProductivos/capacidadProductiva');
})->name('pp.capacidadProductiva');



//gestion ordenes de produccion
Route::get('/gestionPedidos', function() {
    return view('/pedidos/gestionPedidos');
});
Route::get('/altaPedidos', function() {
    return view('/pedidos/altaPedidos');
});

//finalizar ordenes
Route::get('/finalizarPedidos', function() {
    return view('/pedidos/finalizarPedidos');
})->name('finPedido');



//gestion despachos
Route::get('/gestionDespachos', function() {
    return view('/despachos/gestionDespachos');
});

//inicializar despachos
Route::get('/pesajeInicialDespacho', function() {
    return view('/despachos/pesajeInicialDespacho');
})->name('inicioDespacho');

//finalizar despachos
Route::get('/pesajeFinalDespacho', function() {
    return view('/despachos/pesajeFinalDespacho');
})->name('finDespacho');

