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
Route::resource('sucursales','Sucursal\SucursalController');
Route::resource('empleados','Empleado\EmpleadoController');
Route::resource('empleados.contactos','Empleados\EmpleadoContactoController');
Route::resource('empleados.direcciones','Empleados\EmpleadoDireccionController');
Route::get('/', function () {
    return view('index');
});
