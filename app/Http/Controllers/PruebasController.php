<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Mensualidad;
use App\Pagos;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Console\Commands\UpdateMensualidades;

class PruebasController extends Controller
{
    public function index()
    {
        return view('pruebas.mensualidades');
    }

    public function probar(UpdateMensualidades $updateMensualidades){
        $updateMensualidades->handle();
        return redirect()->route('pruebas');
    }
}
