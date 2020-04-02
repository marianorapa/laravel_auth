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
Route::post('/register', 'Auth\RegisterController@RegisterUser')->middleware('App\Http\Middleware\CheckUserExistence');

    //Route::get('/register', 'Auth\RegisterController@CheckUserExistence');

Route::get('/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/login', 'Auth\LoginController@authenticate')->name('login');

Route::get('/logout', 'Auth\LoginController@logout')->name('getLogout');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    //Auth::routes()->middleware('checkUserExistence');


// Rutas de usuario
//Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('App\Http\Middleware\IsAdmin');

Route::get('/usuario', 'UserController@index')->name('usuario')->middleware('auth');



// Rutas de errores
Route::get('/error/not_allowed', 'ErrorController@notAllowed')->name('error.not_permission');