<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Rutas de autenticacion
Route::get('/', function() {
    return view('welcome');
});

Route::get('/register', 'Auth\RegisterController@CheckUserExistence')->name('register');
Route::post('/register', 'Auth\RegisterController@RegisterUser');//>middleware('App\Http\Middleware\CheckUserExistence');

    //Route::get('/register', 'Auth\RegisterController@CheckUserExistence');

Route::get('/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/login', 'Auth\LoginController@authenticate')->name('login');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    //Auth::routes()->middleware('checkUserExistence');


// Rutas protegidas
Route::get('/main', 'HomeController@index')->name('main');

Route::get('/admin', 'AdminController@index')->name('admin');

Route::resource('users', 'UserController');
Route::resource('roles', 'RolesController');
Route::resource('permisos', 'PermisosController');
Route::resource('personas', 'PersonasController');


// GUARDA ACA!!! PORQUE EL USERCONTROLLER GESTIONA USUARIOS, NO NOT_ADMIN! <---
Route::get('/usuario', 'UserController@index')->name('user');

// Rutas de errores
Route::get('/error/not_allowed', 'ErrorController@notAllowed')->name('error.not_permission');