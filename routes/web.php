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


// Route::get('/', function () {
//     return view('index');
// });
// =======
// LOGIN
Route::get('/', function () {
	return redirect()->route('login');
});

// HOME
Route::get('/home', function () {
	if(Auth::check()){
    	return view('principal');
	}else{
		return redirect()->route('login');
	}
})->name('home');

// AGENTES

Route::resource('empleados','Empleado\EmpleadoController');
Route::resource('empleados.contactos','Empleado\EmpleadoContactoController');
Route::resource('empleados.direcciones','Empleado\EmpleadoDireccionController');
Route::resource('empleados.relaciones','Empleado\EmpleadoRelacionController');

// PROSPECTOS
Route::resource('prospectos', 'Prospecto\ProspectoController');
Route::resource('prospectos.documentos', 'Prospecto\DocumentoController');
Route::resource('prospectos.prestamos', 'Prospecto\PrestamoController');
Route::get('prospectos/{prospecto}/prestamos/{prestamo}/pdf','Prospecto\PrestamoController@pdf')->name('prospectos.prestamos.pdf');
Route::resource('prospectos.pagos', 'Pago\PagoController');
Route::get('prospectos/{prospecto}/pagos/{pago}/follow', 'Pago\PagoController@follow')->name('prospectos.pagos.follow');

// SUCURSALES
Route::resource('sucursals', 'Sucursal\SucursalController');

/*AJAX */

// PRECARGAS
Route::resource('bancos', 'Banco\BancoController');

Route::get('buscarsucursales', 'Sucursal\SucursalController@sucursalesAjax')->name('buscarsucursales');
Route::get('buscargerentes', 'Empleado\EmpleadoController@buscarGerentes')->name('buscargerentes');
Route::get('buscarsupervisores', 'Empleado\EmpleadoController@buscarSupervisores')->name('buscarsupervisores');
Route::get('getAsesores', 'Empleado\EmpleadoController@getAsesores')->name('empleados.asesores');

// SEGURIDAD
Route::resource('usuarios', 'Usuario\UsuarioController');
Route::resource('perfils', 'Perfil\PerfilController');

// AUTH
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');