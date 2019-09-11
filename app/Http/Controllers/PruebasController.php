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

class PruebasController extends Controller
{

    public function __construct( PruebaService $pruebaService )
    {
        $this->pruebaService = $pruebaService;
    }

    public function index()
    {
        $contrato = Contrato::find(1);
        $contrato->referencia =1;
        return $contrato->referencia;

        //return $this->pruebaService->handle();

        Contrato::where('id',375)->first()->isValidFechaPago();

        // $empleados_no_usuarios = Empleado::noUsers()->get();
        // return $empleados_no_usuarios;
        // return view('pruebas.mensualidades');
    }

    public function probar(UpdateMensualidades $updateMensualidades){
        $updateMensualidades->handle();
        return redirect()->route('pruebas');
    }
}
