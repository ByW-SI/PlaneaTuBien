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

// HOME
Route::get('/home', function () {
	if(Auth::check()){
    	return view('principal');
	}else{
		return redirect()->route('login');
	}
})->name('home');

Route::get('/denegado',function(){
	return view('errors.denegado');
})->name('denegado');

// AUTH
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// SEGURIDAD
Route::resource('usuarios', 'Usuario\UsuarioController')->middleware('auth');
Route::resource('perfils', 'Perfil\PerfilController')->middleware('auth');

Route::get('cliente/{id}/contratos','Cliente\ClienteContratosController@index');

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
	Route::get('/corrida_financiera','Cliente\PlanController@corrida')->name('corrida_financiera');
	Route::get('/pagar','Cliente\PlanController@formPagos')->name('pagar');
	//Route::get('confirmar-pago', 'Cliente\PlanController@confirmarPago')->name('confirmar-pago'); Queda inutilizada por el momento
	Route::get('/confirmar-deposito', 'Cliente\PlanController@formDeposito')->name('confirmardeposito');
	Route::get('/historial', 'Cliente\PlanController@historial')->name('historial_cliente');
	Route::resource('cliente-pagos', 'Cliente\PagosController');
	Route::post('Cliente-pagos-efectivo','Cliente\PagosController@storePagosEfectivos')->name('store_pago_efectivo');
	Route::post('hoja-pago-efectivo', 'Cliente\PagosController@generacionHojaPagoEfectivo')->name('pago-efectivo-control');
	//Route::resource('cotizacions','Cliente\CotizacionController');
	//Route::resource('/Pagos', 'Pagos\PagoMensualController')->name('clientes.pagos');

});




// PLANES
Route::resource('plans','Plan\PlanController')->middleware('auth');
Route::get('/get-planes','Plan\PlanController@getPlanes')->middleware('auth');

Route::put('/contratos/{contrato}/grupo','Contrato\ContratoController@updateGrupo')->name('contratos.grupo.update');

// GRUPOS
Route::resource('grupos','Grupo\GrupoController')->middleware('auth');
Route::get('grupos/{grupo}/contratos', 'Grupo\GrupoController@listContratos')->name('grupos.listcontratos')->middleware('auth');
Route::get('grupos/{grupo}/contrato/{contrato}/Pagos', 'Grupo\GrupoController@showPagos')->name('grupos.listpagos')->middleware('auth');

// FACTOR DE ACTUALIZACIÓN
Route::resource('factors','Plan\FactorActualizacionController',['except'=>['show','edit','create']])->middleware('auth');

// COTIZADOR
Route::get('cotizador','Plan\CotizadorController@index')->name('cotizador')->middleware('auth');
Route::get('cotizacion/monto/{monto}/plan/{planlibre}','Plan\CotizadorController@getCotizacionPlanLibre')->middleware('auth');
Route::get('export-pdf','Plan\CotizadorController@exportPDF')->name('toPDF')->middleware('auth');
Route::get('export-excel','Plan\CotizadorController@exportExcel')->name('toEXCEL')->middleware('auth');
Route::put('cotizaciones/{cotizacion}/plan/update','Cotizacion\CotizacionController@updatePlan')->name('cotizaciones.planes.update');

// AGENTES

Route::resource('empleados','Empleado\EmpleadoController')->middleware('auth');
Route::post('empleados/undelete','Empleado\EmpleadoController@undelete')->name('empleados.undelete')->middleware('auth');
Route::get('empleados/deleted/list','Empleado\EmpleadoController@deletedList')->name('empleados.deleted.list')->middleware('auth');
Route::get('empleados/deleted/show/{id}','Empleado\EmpleadoController@showDeleted')->name('empleados.show.deleted')->middleware('auth');
Route::get('agentes','Empleado\EmpleadoController@indexAgentes')->name('agentes.index')->middleware('auth');
Route::resource('empleados.contactos','Empleado\EmpleadoContactoController')->middleware('auth');
Route::resource('empleados.direcciones','Empleado\EmpleadoDireccionController')->middleware('auth');
Route::resource('empleados.relaciones','Empleado\EmpleadoRelacionController')->middleware('auth');

// CRM General
Route::resource('crms', 'CRM\CrmGeneralController');

// Empleados

Route::resource('empleados.laborals','Empleado\EmpleadoDatoLabController')->middleware('auth');
Route::resource('empleados.accidentes','Empleado\EmpleadoAccidenteController');
Route::resource('empleados.beneficiario','Empleado\EmpleadoBeneficiarioController',['only'=>['index','create','store','edit','update']]);
Route::resource('empleados.permisos','Empleado\EmpleadoPermisoController');
Route::resource('empleados.faltas','Empleado\EmpleadoFaltaController');
Route::post('empleados/faltas/actualizar','Empleado\EmpleadoFaltaController@actualizar')->name('empleados.faltas.actualizar');
Route::resource('empleados.vacacions','Empleado\EmpleadoVacacionController');
Route::resource('empleados.estudios','Empleado\EmpleadoEstudioController');
Route::resource('empleados.emergencias','Empleado\EmpleadoEmergenciaController');
Route::resource('empleados.disciplinas','Empleado\EmpleadoFaltaAdministrativaController');

Route::resource('empleados.crms','Empleado\EmpleadoCRMController',['only'=>['index']])->middleware('auth');
Route::resource('empleados.prospectos','Empleado\EmpleadoProspectoController')->middleware('auth');
Route::resource('empleados.prospectos.cotizacions','Empleado\EmpleadoProspectoCotizacionController')->middleware('auth');
Route::resource('empleados.prospectos.crms','Empleado\EmpleadoProspectoCRMController')->middleware('auth');
Route::post('crms/{crm}/tareas/{tarea}/checked','Empleado\EmpleadoProspectoCRMController@tareaChecked')->name('crms.tareas.tarea_checked')->middleware('auth');

Route::get('prospectos/en-presolicitud','Prospecto\ProspectoController@enPresolicitud')->name('prospectos.en_presolicitud.index')->middleware('auth');

//Rutas para el cambio de Plan libre a otro Plan
Route::get('cambio-plan/{prospecto}','Empleado\ActualizacionPlanProspectoController@index')->name('cambio-plan')->middleware('auth');
Route::post('cambio-plan/{prospecto}/{cotizacion}','Empleado\ActualizacionPlanProspectoController@update')->name('cambio-plan-update')->middleware('auth');


// PROSPECTOS VISTA APARTE
Route::get('unete','Prospecto\ProspectoController@formprospecto')->name('prospecto.create');
Route::post('unete','Prospecto\ProspectoController@submitprospecto')->name('prospecto.submit');

// PROSPECTOS
Route::post('prospectos/{prospecto}/asignar/directivo', 'Prospecto\ProspectoController@asignarDirectivo')->middleware('auth')->name('prospectos.asignar.directivo');
Route::resource('prospectos', 'Prospecto\ProspectoController')->middleware('auth');
Route::get('prospectos/create/excel', 'Prospecto\ProspectoController@createExcel')->name('prospectos.alta.excel')->middleware('auth');
Route::post('prospectos/create/excel', 'Prospecto\ProspectoController@storeExcel')->name('prospectos.store.excel')->middleware('auth');
Route::get('prospectos/asignar/asesor', 'Prospecto\ProspectoController@viewAsignar')->name('prospectos.asignar.asesor')->middleware('auth');
Route::post('prospectos/asignar/asesor-temporal-indefinido', 'Prospecto\ProspectoController@asignarAsesorTemporalIndefinido')->name('prospectos.asignar_asesor_temporal_indefinido')->middleware('auth');
Route::post('prospectos/asignar/asesor-temporal', 'Prospecto\ProspectoController@asignarAsesorTemporal')->name('prospectos.asignar_asesor_temporal')->middleware('auth');
Route::post('prospectos/asignar/asesor', 'Prospecto\ProspectoController@asignarAsesor')->name('prospectos.asignar.asesor.store')->middleware('auth');
Route::post('pagos/{id}/aprobar','Pago\PagoController@aprobar')->middleware('auth')->name('aprobar.pago');
Route::get('prospectos/{prospecto}/asesor/create','Prospecto\ProspectoController@asignarAsesor')->name('prospectos.asesor.create')->middleware('auth');
Route::resource('prospectos.documentos', 'Prospecto\DocumentoController')->middleware('auth');
Route::resource('prospectos.cotizacions', 'Prospecto\CotizacionController')->middleware('auth');
Route::get('prospectos/{prospecto}/cotizacions/{cotizacion}/pdf','Prospecto\CotizacionController@pdf')->name('prospectos.cotizacions.pdf')->middleware('auth');
Route::get('empleado/{empleado}/prospectos/{prospecto}/cotizacions/{cotizacion}/sendmail','Empleado\EmpleadoProspectoCotizacionController@sendMail')->name('empleados.prospectos.cotizacions.pdf.sendMail')->middleware('auth');
Route::resource('prospectos.pagos', 'Pago\PagoController')->middleware('auth');
Route::get('prospectos/{prospecto}/pagos/{pago}/follow', 'Pago\PagoController@follow')->name('prospectos.pagos.follow')->middleware('auth');
	// PROSPECTOS - SEGUIMIENTO DE LLAMADAS.
Route::get('seguimiento/llamadas', 'Prospecto\Seguimiento\SeguimientoLlamadasController@index')->name('seguimiento.llamadas.index')->middleware('auth');
Route::post('seguimiento/llamadas', 'Prospecto\Seguimiento\SeguimientoLlamadasController@store')->name('seguimiento.llamadas.store')->middleware('auth');
Route::post('seguimiento/llamadas/nocalificado', 'Prospecto\Seguimiento\SeguimientoLlamadasController@noCalificado')->name('seguimiento.llamadas.nocalificado')->middleware('auth');

// CITAS
Route::post('volver-a-llamar', 'VolverALlamarController@store')->name('volver_a_llamar.store');
Route::get('volver-a-llamar', 'VolverALlamarController@index')->name('volver_a_llamar.index');
Route::put('citas/confirmadas/{citas}/asistir', 'Cita\CitaController@asistir')->name('citas.confirmadas.asistio');
Route::put('citas/pendientes/{citas}/update', 'Cita\CitaController@updatePendientes')->name('citas.pendientes.update');
Route::get('citas/pendientes/reprogramar', 'Cita\CitaController@pendientesReprogramar')->name('citas.pendientes.reprogramar.index');
Route::get('citas/pendientes', 'Cita\CitaController@pendientes')->name('citas.pendientes.index');
Route::get('citas/{citas}/canceladas/reactivar', 'Cita\CitaController@reactivar')->name('citas.canceladas.reactivar');
Route::get('citas/canceladas', 'Cita\CitaController@canceladas')->name('citas.canceladas.index');
Route::get('citas/reprogramables', 'Cita\CitaController@reprogramables')->name('citas.reprogramables.index');
Route::post('citas/{citas}/reprogramables', 'Cita\CitaController@reprogramablesStore')->name('citas.reprogramables.store');
Route::post('citas/confirmadas/{citas}/update', 'Cita\CitaController@confirmadasUpdate')->name('citas.confirmadas.update');
Route::get('citas/confirmadas', 'Cita\CitaController@confirmadas')->name('citas.confirmadas');
Route::get('citas', 'Cita\CitaController@index')->name('citas.index');
Route::post('citas/store', 'Cita\CitaController@store')->name('citas.store');
Route::put('citas/{citas}/update', 'Cita\CitaController@update')->name('citas.update');

// SUCURSALES
Route::resource('sucursals', 'Sucursal\SucursalController')->middleware('auth');

// MEDIOS CONTACTO
Route::resource('medios_contacto', 'MedioContactoController')->middleware('auth');

// CREAR PERFIL CON PROSPECTO Y COTIZACION

Route::resource('prospectos.perfils','Prospecto\Cotizacion\PerfilController',['only'=>['create','store']])->middleware('auth');
Route::get('prospectos/{prospecto}/perfils/create','Prospecto\Cotizacion\PerfilController@create')->name('crear-perfil-sin-cotizacion')->middleware('auth');

Route::namespace('Prospecto\Cliente\Perfil')
	->prefix('prospectos/{prospecto}/perfil')
	->name('prospectos.perfil.')
	->group(function () {
	    Route::resource('datos_personal','DatosPersonalesController',['except'=>'show'])->middleware('auth');
	    Route::get('/pdf','DatosPersonalesController@pdf')->name('pdf');
	    Route::resource('historial_crediticio','HistorialCrediticioController',['except'=>'show'])->middleware('auth');
	    Route::resource('inmueble_pretendido','InmueblePretendidoController',['except'=>'show'])->middleware('auth');
	    Route::resource('referencia_personals','ReferenciaPersonalController')->middleware('auth');
		// PRESOLICITUD
		Route::get('/presolicitud/pdf','DatosPersonalesController@presolicitud')->name('presolicitud');
	});

Route::resource('Cliente','Cliente\ClienteController',['except'=>'show'])->middleware('auth');
Route::put('presolicitudes/{presolicitud}/modificar-cotizacion','Prospecto\Cliente\Presolicitud\PresolicitudController@modificarCotizacion')->name('presolicitudes.cotizaciones.cambiar');

Route::namespace('Prospecto\Cliente\Presolicitud')
	->prefix('prospectos/{prospecto}')
	->name('prospectos.')
	->group(function(){
		Route::get('/presolicitud/{presolicitud}/contrato/{contrato}/anexo_plan_libre','Documentos\DocumentosController@anexoPlanLibre')->name('presolicitud.contratos.anexo_plan_libre');
		Route::resource('presolicitud','PresolicitudController')->middleware('auth');
		Route::resource('presolicitud.credencials','CredencialController',['except'=>['index','destroy']]);
		Route::resource('presolicitud.conyuge','PresolicitudConyugeController',['except'=>['show']])->middleware('auth');
		Route::resource('presolicitud.beneficiarios','PresolicitudBeneficiarioController')->middleware('auth');
		Route::resource('presolicitud.recibos','PresolicitudReciboController')->middleware('auth');
		Route::resource('presolicitud.referencias','PresolicitudReferenciaController')->middleware('auth');
		// Premio de mensualidades
		Route::get('/presolicitud/{presolicitud}/contratos/{contrato}/premio_mensualidades_adelantadas','Documentos\DocumentosController@premioMensualidadesAdelantadas')->name('contratos.premios_mensualidades_adelantadas');
		// aviso de privacidad
		Route::get('/presolicitud/{presolicitud}/aviso_privacidad','Documentos\DocumentosController@avisoPrivacidad')->name('presolicitud.aviso_privacidad');
		// carta de bienvenida
		Route::get('/presolicitud/{presolicitud}/carta_bienvenida','Documentos\DocumentosController@cartaBienvenida')->name('presolicitud.carta_bienvenida');
		// cuestionario de calidad
		Route::get('/presolicitud/{presolicitud}/cuestionario_calidad','Documentos\DocumentosController@cuestionarioCalidad')->name('presolicitud.cuestionario_calidad');
		// recibo
		Route::get('/presolicitud/{presolicitud}/recibo/{recibo}/pdf','PresolicitudReciboController@pdf')->name('presolicitud.recibos.pdf');
		// manual de consumidor
		Route::get('/presolicitud/{presolicitud}/manual_consumidor','Documentos\DocumentosController@manualConsumidor')->name('presolicitud.manual');
		// consentimiento de seguro
		Route::get('/presolicitud/{presolicitud}/consentimiento_seguro','Documentos\DocumentosController@consentimientoSeguro')->name('presolicitud.consentimiento_seguro');
		Route::get('/presolicitud/{presolicitud}/contratos','Documentos\DocumentosController@index')->name('presolicitud.contratos.index');
		Route::get('/presolicitud/{presolicitud}/contrato/{contrato}/contrato','Documentos\DocumentosController@contrato')->name('presolicitud.contratos.contrato');
		Route::get('/presolicitud/{presolicitud}/declaracion_salud','Documentos\DocumentosController@declaracionSalud')->name('presolicitud.declaracion_salud');
		Route::get('/presolicitud/{presolicitud}/contrato/{contrato}/domiciliacion','Documentos\DocumentosController@formatoDomicilio')->name('presolicitud.contratos.domiciliacion');
		Route::get('/presolicitud/{presolicitud}/contrato/{contrato}/ficha_deposito','Documentos\DocumentosController@fichaDeposito')->name('presolicitud.contratos.ficha_deposito');
		Route::get('/presolicitud/{presolicitud}/contrato/{contrato}/ficha_deposito_plan_libre','Documentos\DocumentosController@fichaDepositoPlanLibre')->name('presolicitud.contratos.ficha_deposito_plan_libre');
		Route::get('/presolicitud/{presolicitud}/contrato/{contrato}/anexo_tanda','Documentos\DocumentosController@anexoTanda')->name('presolicitud.contratos.anexo_tanda');
		Route::get('/presolicitud/{presolicitud}/contrato/{contrato}/anexo_tanda_clasica','Documentos\DocumentosController@anexoTandaClasica')->name('presolicitud.contratos.anexo_tanda_clasica');
		Route::get('/presolicitud/{presolicitud}/contrato/{contrato}/anexo_inscripcion_diferida','Documentos\DocumentosController@anexoInscripcionDiferida')->name('presolicitud.contratos.anexo_inscripcion_diferida');

	});
Route::resource('contratos.checklist','Prospecto\Cliente\Presolicitud\ChecklistFolderController')->middleware('auth');
Route::get('contratos/{contrato}/checklist/{checklist}/aprobar/{aprobar}', 'Prospecto\Cliente\Presolicitud\ChecklistFolderController@aprobarChecklist')->name('checklist.aprobar')->middleware('auth');
Route::resource('contratos.domiciliacion','Prospecto\Cliente\Presolicitud\Contrato\DomiciliacionController')->middleware('auth');
Route::resource('presolicituds.credencials','Prospecto\Cliente\Presolicitud\CredencialController',['only','create'])->middleware('auth');

Route::post('navegacion_contrato','Cliente\ClienteController@navegacion_contrato');
Route::post('get_contrato','Cliente\ClienteController@get_contrato');
Route::post('get_prepagos','Cliente\ClienteController@get_prepagos');
Route::post('get_gestion','Cliente\ClienteController@get_gestion');
Route::post('gestion.store','Cliente\ClienteController@gestionStore')



// PRECARGAS
Route::resource('bancos', 'Banco\BancoController')->middleware('precargas:Bancos')->middleware('auth');
Route::resource('areas','Precargas\TipoAreaController')->middleware('precargas:Areas')->middleware('auth');
Route::resource('bajas','Precargas\TipoBajaController')->middleware('precargas:Bajas')->middleware('auth');
Route::resource('contratos','Precargas\TipoContratoController')->middleware('precargas:Contratos')->middleware('auth');
Route::resource('puestos','Precargas\TipoPuestoController')->middleware('precargas:Puestos')->middleware('auth');
Route::resource('tasks','Precargas\TaskController')->middleware('precargas:Tareas')->middleware('auth');
Route::resource('tipo_promocions','Precargas\TipoPromocionController')->middleware('precargas:Tipo de Promociones','auth');
Route::resource('promocions','Precargas\PromocionController')->middleware('auth');

// AJAX
Route::get('buscarsucursales', 'Sucursal\SucursalController@sucursalesAjax')->name('buscarsucursales');
Route::get('buscargerentes', 'Empleado\EmpleadoController@buscarGerentes')->name('buscargerentes');
Route::get('buscarsupervisores', 'Empleado\EmpleadoController@buscarSupervisores')->name('buscarsupervisores');
Route::get('getAsesores', 'Empleado\EmpleadoController@getAsesores')->name('empleados.asesores');
Route::get('promocion/{promocion}','Precargas\PromocionController@getPromo')->name('getPromo');

Route::resource('prospectos.cotizacions.pagos','Prospecto\Cotizacion\PagoInscripcionController')->middleware('auth');

// AUTH
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');





// PAGOS
Route::post('pagos/deposito/store','Pagos\PagoDepositoController@store')->name('pagos.deposito.store');
Route::get('pagos/realizados','Pagos\PagosController@index')->name('pagos.realizados');
Route::post('pagos/realizados','Pagos\PagosController@index')->name('pagos.realizados');
Route::resource('pagos', 'Pagos\PagoInscripcionController',['only'=>['index','show']])->middleware('auth');
Route::get('excelpagos','CargarEstadoCuentaExcelController@show')->name('excelpagos')->middleware('auth');
Route::post('excel.store','CargarEstadoCuentaExcelController@store')->name('excel.store')->middleware('auth');
Route::get('excel.find','CargarEstadoCuentaExcelController@show')->name('excel.find')->middleware('auth');
Route::get('estadoCuenta.detalle','EstadoCuentaController@detalle')->name('estadoCuenta.detalle')->middleware('auth');
Route::get('estadoCuenta/{deposito_efectivo}', 'EstadoCuentaController@edit')->name('estadoCuenta.edit')->middleware('auth');
Route::post('estado-cuenta', 'EstadoCuentaController@validarPago')->name('depositoPagoValidar')->middleware('auth');
Route::post('estado-cuenta-rechazar', 'EstadoCuentaController@rechazarPago')->name('depositoPagoRechazar')->middleware('auth');
Route::put('/pagos/{pago}/status','Pagos\PagoInscripcionController@changeStatus')->name('pagos.update_status')->middleware('auth');
Route::get('/pagos/{pago}/recibo_provisional','Pagos\ReciboProvisionalController@formReciboProvisional')->name('pagos.recibo_provisional')->middleware('auth');
Route::get('/pagos/{pago}/recibo_provisional/show','Pagos\ReciboProvisionalController@showReciboProvisional')->name('pagos.recibo_provisional.show')->middleware('auth');
Route::post('/pagos/{pago}/recibo_provisional','Pagos\ReciboProvisionalController@submitReciboProvisional')->name('pagos.submit_recibo_provisional')->middleware('auth');
Route::get('pagos/busqueda/referencia','Pagos\BuscarReferenciaController@index')->name('pagos.asignar');
Route::post('pagos/busqueda/referencia','Pagos\BuscarReferenciaController@show')->name('pagos.referencia.buscar');

// CODIGOS POSTAL
Route::get('cp/{cp}','CodigoPostal\CodigoPostalController@getCP')->name('cp.get');
Route::get('cp/{cp}/{colonia}','CodigoPostal\CodigoPostalController@getColonia')->name('colonia.get');

// Polizas

Route::resource('polizas','Poliza\PolizaController')->middleware('auth');

// autorización de cotizaciones con inscripcion 0
Route::resource('cotizacion0','Admin\Cotizacion0Controller',['only'=>['index','show','update','destroy']])->middleware('auth');


Route::get('pruebas','PruebasController@index')->name('pruebas');



//+-+-+-+-+-+-+-+  RUTA PROVISIONAL PARA SUBIR EL EXCEL DE LOS CLIENTES +-+-+-+-+-+-+-
Route::resource('excel-clientes', 'ClienteExcelController', ['only'=>['index','store']]);
//http://cie.adquiramexico.com/#/