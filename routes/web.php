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

// LOGIN
Route::get('/', function () {
	return redirect()->route('login');
});


Route::prefix('clientes')->group(function(){
	Route::get('/login','Auth\ClienteLoginController@showLoginForm')->name('cliente.login');
	Route::post('/login','Auth\ClienteLoginController@login')->name('cliente.login.submit');
	Route::get('/','ClienteCredentialsController@index')->name('cliente.dashboard');
	Route::post('/logout','Auth\ClienteLoginController@logout')->name('cliente.logout');

	// Reestablecer las contraseñas 
	Route::post('/password/email','Auth\ClienteForgotPasswordController@sendResetLinkEmail')->name('cliente.password.email');
	Route::get('/password/reset','Auth\ClienteForgotPasswordController@showLinkRequestForm')->name('cliente.password.request');
	Route::post('/password/reset','Auth\ClienteResetPasswordController@reset');
	Route::get('/password/reset/{token}','Auth\ClienteResetPasswordController@showResetForm')->name('cliente.password.reset');
	Route::resource('cotizacions','Cliente\CotizacionController');

});

// AUTH
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// HOME
Route::get('/home', function () {
	if(Auth::check()){
    	return view('principal');
	}else{
		return redirect()->route('login');
	}
})->name('home');

// PLANES
Route::resource('plans','Plan\PlanController');

// GRUPOS
Route::resource('grupos','Grupo\GrupoController');

// COTIZADOR
Route::get('cotizador','Plan\CotizadorController@index')->name('cotizador');


// AGENTES
Route::resource('empleados','Empleado\EmpleadoController');
Route::resource('empleados.contactos','Empleado\EmpleadoContactoController');
Route::resource('empleados.direcciones','Empleado\EmpleadoDireccionController');
Route::resource('empleados.relaciones','Empleado\EmpleadoRelacionController');

// Empleados

Route::resource('empleados.laborals','Empleado\EmpleadoDatoLabController');

Route::resource('empleados.crms','Empleado\EmpleadoCRMController',['only'=>['index']]);
Route::resource('empleados.prospectos','Empleado\EmpleadoProspectoController');
Route::resource('empleados.prospectos.cotizacions','Empleado\EmpleadoProspectoCotizacionController');
Route::resource('empleados.prospectos.crms','Empleado\EmpleadoProspectoCRMController');
Route::post('crms/{crm}/tareas/{tarea}/checked','Empleado\EmpleadoProspectoCRMController@tareaChecked')->name('crms.tareas.tarea_checked');

// PROSPECTOS VISTA APARTE
Route::get('unete','Prospecto\ProspectoController@formprospecto')->name('prospecto.create');
Route::post('unete','Prospecto\ProspectoController@submitprospecto')->name('prospecto.submit');

// PROSPECTOS
Route::resource('prospectos', 'Prospecto\ProspectoController');
Route::get('prospectos/{prospecto}/asesor/create','Prospecto\ProspectoController@asignarAsesor')->name('prospectos.asesor.create');
Route::resource('prospectos.documentos', 'Prospecto\DocumentoController');
Route::resource('prospectos.cotizacions', 'Prospecto\CotizacionController');
Route::get('prospectos/{prospecto}/cotizacions/{cotizacion}/pdf','Prospecto\CotizacionController@pdf')->name('prospectos.cotizacions.pdf');
Route::get('empleado/{empleado}/prospectos/{prospecto}/cotizacions/{cotizacion}/sendmail','Empleado\EmpleadoProspectoCotizacionController@sendMail')->name('empleados.prospectos.cotizacions.pdf.sendMail');
Route::resource('prospectos.pagos', 'Pago\PagoController');
Route::get('prospectos/{prospecto}/pagos/{pago}/follow', 'Pago\PagoController@follow')->name('prospectos.pagos.follow');

// SUCURSALES
Route::resource('sucursals', 'Sucursal\SucursalController');

// CREAR PERFIL CON PROSPECTO Y COTIZACION

Route::resource('prospectos.cotizacions.perfils','Prospecto\Cotizacion\PerfilController',['only'=>['create','store']]);

Route::namespace('Prospecto\Cliente\Perfil')
	->prefix('prospectos/{prospecto}/perfil')
	->name('prospectos.perfil.')
	->group(function () {
	    Route::resource('datos_personal','DatosPersonalesController',['except'=>'show']);
	    Route::get('/pdf','DatosPersonalesController@pdf')->name('pdf');
	    Route::resource('historial_crediticio','HistorialCrediticioController',['except'=>'show']);
	    Route::resource('inmueble_pretendido','InmueblePretendidoController',['except'=>'show']);
	    Route::resource('referencia_personals','ReferenciaPersonalController');
		// PRESOLICITUD
		Route::get('/presolicitud/pdf','DatosPersonalesController@presolicitud')->name('presolicitud');
	});
Route::namespace('Prospecto\Cliente\Presolicitud')
	->prefix('prospectos/{prospecto}')
	->name('prospectos.')
	->group(function(){
		Route::resource('presolicitud','PresolicitudController',['except'=>['show']]);
		Route::resource('presolicitud.credencials','CredencialController',['except'=>['index','destroy']]);
		Route::resource('presolicitud.conyuge','PresolicitudConyugeController',['except'=>['show']]);
		Route::resource('presolicitud.beneficiarios','PresolicitudBeneficiarioController');
		Route::resource('presolicitud.recibos','PresolicitudReciboController');
		Route::get('/presolicitud/{presolicitud}/recibo/{recibo}/pdf','PresolicitudReciboController@pdf')->name('presolicitud.recibos.pdf');
		Route::resource('presolicitud.referencias','PresolicitudReferenciaController');
		Route::get('/presolicitud/{presolicitud}/manual_consumidor','Documentos\DocumentosController@manualConsumidor')->name('presolicitud.manual');
		Route::get('/presolicitud/{presolicitud}/contrato','Documentos\DocumentosController@contrato')->name('presolicitud.contrato');
		Route::get('/presolicitud/{presolicitud}/aviso_privacidad','Documentos\DocumentosController@avisoPrivacidad')->name('presolicitud.aviso_privacidad');
		Route::get('/presolicitud/{presolicitud}/carta_bienvenida','Documentos\DocumentosController@cartaBienvenida')->name('presolicitud.carta_bienvenida');
		Route::get('/presolicitud/{presolicitud}/consentimiento_seguro','Documentos\DocumentosController@consentimientoSeguro')->name('presolicitud.consentimiento_seguro');
		Route::get('/presolicitud/{presolicitud}/cuestionario_calidad','Documentos\DocumentosController@cuestionarioCalidad')->name('presolicitud.cuestionario_calidad');
		Route::get('/presolicitud/{presolicitud}/declaracion_salud','Documentos\DocumentosController@declaracionSalud')->name('presolicitud.declaracion_salud');
		Route::get('/presolicitud/{presolicitud}/domiciliacion','Documentos\DocumentosController@formatoDomicilio')->name('presolicitud.domiciliacion');
		Route::get('/presolicitud/{presolicitud}/ficha_deposito','Documentos\DocumentosController@fichaDeposito')->name('presolicitud.ficha_deposito');
		Route::get('/presolicitud/{presolicitud}/anexo_tanda','Documentos\DocumentosController@anexoTanda')->name('presolicitud.anexo_tanda');

	});
Route::resource('presolicituds.checklist','Prospecto\Cliente\ChecklistFolderController');



// PRECARGAS
Route::resource('bancos', 'Banco\BancoController');
Route::resource('areas','Precargas\TipoAreaController');
Route::resource('bajas','Precargas\TipoBajaController');
Route::resource('contratos','Precargas\TipoContratoController');
Route::resource('puestos','Precargas\TipoPuestoController');
Route::resource('tasks','Precargas\TaskController');
Route::resource('tipo_promocions','Precargas\TipoPromocionController');
Route::resource('promocions','Precargas\PromocionController');

// AJAX
Route::get('buscarsucursales', 'Sucursal\SucursalController@sucursalesAjax')->name('buscarsucursales');
Route::get('buscargerentes', 'Empleado\EmpleadoController@buscarGerentes')->name('buscargerentes');
Route::get('buscarsupervisores', 'Empleado\EmpleadoController@buscarSupervisores')->name('buscarsupervisores');
Route::get('getAsesores', 'Empleado\EmpleadoController@getAsesores')->name('empleados.asesores');
Route::get('promocion/{promocion}','Precargas\PromocionController@getPromo')->name('getPromo');
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