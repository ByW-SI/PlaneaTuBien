<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Mensualidad;
use App\Pagos;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Console\Commands\UpdateMensualidades;
use App\Empleado;

class PruebasController extends Controller
{
    public function index()
    {
        $empleados_no_usuarios = Empleado::noUsers()->get();
        return $empleados_no_usuarios;



        // return view('pruebas.mensualidades');
    }

    public function probar(UpdateMensualidades $updateMensualidades){
        $updateMensualidades->handle();
        return redirect()->route('pruebas');
    }
}
