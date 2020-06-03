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
Route::get('/balanzas/ingreso/destroy/{id}', 'EntradaController@destroy')->name('balanzas.ingresos.destroy');

Route::get('/balanzas/ingreso/inicial', 'EntradaController@registroInsumoInicial')
    ->name('balanzas.ingresos.inicial');

Route::post('/balanzas/ingreso/inicial', 'EntradaController@guardarEntradaInicial')
    ->name('balanzas.ingresos.inicial.guardar');

Route::get('/balanzas/ingreso/finalizar/{id}', 'EntradaController@registroInsumoFinal')
    ->name('balanzas.ingresos.final');

Route::post('/balanzas/ingreso/finalizar', 'EntradaController@finalizarEntradaInsumo')
    ->name('balanzas.ingresos.final.guardar');

Route::get('/administracion', 'AdministracionController@index')->name('administracion.menu');

Route::get('/administracion/stock', 'StockController@index')->name('administracion.stock');
Route::get('/administracion/stock/insumos', 'StockController@indexInsumos')->name('administracion.stock.insumos');
Route::get('/administracion/stock/productos', 'StockController@indexProductos')->name('administracion.stock.productos');


Route::get('/administracion/empresas', 'EmpresasController@index')
    ->name('administracion.empresas');


Route::resource('pedidos', 'OrdenProduccionController');
Route::get('pedidos/finalize/{id}', 'OrdenProduccionController@finalize')->name('pedidos.finalize');
Route::get('pedidos/cancel/{id}', 'OrdenProduccionController@cancel')->name('pedidos.cancel');

Route::resource('despachos', 'DespachoController');
Route::get('despachos/finalize/{id}', 'DespachoController@finalizeView')->name('despachos.finalize.view');
Route::post('despachos/finalize', 'DespachoController@finalizeDespacho')->name('despachos.finalize.post');
Route::get('despachos/cancel/{id}', 'DespachoController@destroy')->name('despachos.destroy');

Route::get('/parametros', 'ParametrosController@index')->name('parametros.index');

Route::get('/parametros/precio/definir', 'ParametrosController@definirPrecio')->name('parametros.precio.view');
Route::post('/parametros/precio/guardar', 'ParametrosController@registrarPrecio')->name('parametros.precio.post');
Route::get('/parametros/precio', 'ParametrosController@indexPrecio')->name('parametros.precio.index');


Route::get('/parametros/capacidad/definir', 'ParametrosController@definirCapacidad')
    ->name('parametros.capacidad.view');
Route::post('/parametros/capacidad/guardar', 'ParametrosController@registrarCapacidad')
    ->name('parametros.capacidad.post');

Route::get('/parametros/capacidad', 'ParametrosController@indexCapacidad')->name('parametros.capacidad.index');




// Rutas de errores
Route::get('/error/not_allowed', 'ErrorController@notAllowed')->name('error.not_permission');


//definir precio x kg
Route::get('/precioXkg', function() {
    return view('/gerencia/parametrosProductivos/precioXkg');
})->name('pp.precio');

//gestion parametros productivos
Route::get('/gestionParametrosProductivos', function() {
    return view('/gerencia/parametrosProductivos/gestionParametrosProductivos');
});

//definir capacidad productiva
Route::get('/capacidadProductiva', function() {
    return view('gerencia/parametrosProductivos/capacidadProductiva');
})->name('pp.capacidadProductiva');



//gestion ordenes de produccion
Route::get('/gestionPedidos', function() {
    return view('administracion/pedidos/gestionPedidos');
});

//alta de pedido de produccion
/*Route::get('/altaPedidos', function() {
    return view('/administracion/pedidos/altaPedidosNew');
})->name('administracion.pedidos.altaPedidos');*/
/*Route::get('/altaPedidosnew', function() {
    return view('/administracion/pedidos/altaPedidosNew');
})->name('altaPedidosNew');*/

//finalizar ordenes
Route::get('/finalizarPedidos', function() {
    return view('/administracion/pedidos/finalizarPedidos');
})->name('finPedido');


//gestion despachos
Route::get('/gestionDespachos', function() {
    return view('/balanzas/despachos/gestionDespachos');
});

//inicializar despachos
Route::get('/pesajeInicialDespacho', function() {
    return view('/balanzas/despachos/pesajeInicialDespacho');
})->name('inicioDespacho');

//finalizar despachos
Route::get('/pesajeFinalDespacho', function() {
    return view('/balanzas/despachos/pesajeFinalDespacho');
})->name('finDespacho');



///peticiones asincrionas js
route::get('/insumosasinc', 'EntradaController@getInsumosTrazables');
route::get('/insumostodosasinc', 'EntradaController@getInsumosNoTrazables');
route::get('/localidades', 'LocalidadController@getLocalidad'); //cambiar a un controlador o ponerlo en el controlador de persona.
route::get('/getProductoCliente', 'OrdenProduccionController@getProductoCliente')->name("productos");
route::get('/getFormulaProducto', 'OrdenProduccionController@getFormulaProducto'); // este es el que se usa
route::get('/getFabricaProdForm', 'OrdenProduccionController@getFabricaProdForm');
route::get('/getCapacidadProductivaRestante', 'ParametrosController@getCapacidadRestante');
//peticion asincronica para despacho
route::get('/getOP', 'DespachoController@getOP');
route::get('/getSaldoOp', 'OrdenProduccionController@getSaldoOp');

//pdf
route::get('/personapdf', 'PersonaController@getPdfAll')->name('persona.pdf');
//pdf pedidos
route::get('/pedidopdf', 'OrdenProduccionController@getPdfAll')->name('pedido.pdf');
//pdf ticket salida
route::get('/ticketSalidapdf/{id}', 'DespachoController@getPdfAll')->name('ticketSalida.pdf');
//pdf ticket entrada
route::get('/ticketEntradapdf/{id}', 'EntradaController@getPdfAll')->name('ticketEntrada.pdf');


//peticion asincrona para create user
route::get('/autocompletar','PersonaController@autocompletar')->name('autocompletarPersonas');



//vistas para formula
//Route::get('/createFormula', function() {
//    return view('formula.createFormula');
//});
Route::resource('formula', 'FormulaController');
//route::get('/formulaIndex','FormulaController@index')->name('formula.index');
//route::get('/formulaCreate','FormulaController@create')->name('formula.create');
route::get('/getAllInsumos','FormulaController@getAllInsumos')->name('allInsumos');



//pedidos asincronico

route::get('/getpedidosjs','OrdenProduccionController@getpedidosjs')->name('allPedidos');


//
