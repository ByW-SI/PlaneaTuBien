<?php

namespace App\Http\Controllers\Prospecto\Seguimiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Prospecto;

class SeguimientoLlamadasController extends Controller
{
    /**
     * Muestra una lista con los prospectos con estatus seguimeinto de llamadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$empleado = Auth::user()->empleado;
        if ($empleado->tipo == 'Admin') {
        	$prospectos = Prospecto::where('estatus_id', '1')->get();
        } else {
        	$prospectos = $empleado->prospectos;
        }
        return view('prospectos.seguimientoLlamadas.index', compact('prospectos'));
    }
}
