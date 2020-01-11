<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('planes/{p_ahorrado}','Plan\PlanController@getPlanes');
Route::get('cotizar/{monto}/{plan_id}/{descuento}','Plan\CotizadorController@calcular');
Route::get('inscripcion/{monto}/{plan_id}/{descuento}','Plan\CotizadorController@inscripcion');

Route::post('seguimiento_llamadas/store', 'Api\ApiSeguimientoLlamadaController@store');

Route::get('empleados/{id}','Empleado\ApiEmpleadoController@getEmpleado');