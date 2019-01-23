<?php

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

// HOME
Route::get('/', function () {
    return view('index');
});

// AGENTES
Route::resource('empleados','Empleado\EmpleadoController');
Route::resource('empleados.contactos','Empleado\EmpleadoContactoController');
Route::resource('empleados.direcciones','Empleado\EmpleadoDireccionController');
Route::resource('empleados.relaciones','Empleado\EmpleadoRelacionController');

// PROSPECTOS
Route::resource('prospectos', 'Prospecto\ProspectoController');
Route::resource('prospectos.documentos', 'Prospecto\DocumentoController');
Route::resource('prospectos.prestamos', 'Prospecto\PrestamoController');
Route::resource('prospectos.pagos', 'Pago\PagoController');

// SUCURSALES
Route::resource('sucursals', 'Sucursal\SucursalController');

// PRECARGAS
Route::resource('bancos', 'Banco\BancoController');

// AJAX
Route::get('buscarsucursales', 'Sucursal\SucursalController@sucursalesAjax')->name('buscarsucursales');
Route::get('buscargerentes', 'Empleado\EmpleadoController@buscarGerentes')->name('buscargerentes');
Route::get('buscarsupervisores', 'Empleado\EmpleadoController@buscarSupervisores')->name('buscarsupervisores');
Route::get('getAsesores', 'Empleado\EmpleadoController@getAsesores')->name('empleados.asesores');



