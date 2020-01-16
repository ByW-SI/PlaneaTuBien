<?php

namespace App\Http\Controllers;

use App\Classes\Services\PruebaService;
use App\Contrato;
use App\Mensualidad;
use App\Pagos;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Console\Commands\UpdateMensualidades;
use App\Empleado;
use App\Prospecto;
use App\TipoContrato;
use App\TipoJornada;

class PruebasController extends Controller
{
    public function index()
    {
        $asesor = Empleado::find(3);
        $prospecto = Prospecto::find(4);
        dd($asesor->tieneProspecto($prospecto));
        return $asesor->tieneProspecto($prospecto);
    }
}
