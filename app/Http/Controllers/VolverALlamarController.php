<?php

namespace App\Http\Controllers;

use App\Prospecto;
use App\ResultadoLlamada;
use Illuminate\Http\Request;
use App\Services\VolverALlamar\StoreVolverALlamarService;
use Illuminate\Support\Facades\Auth;

class VolverALlamarController extends Controller
{
    public function index()
    {
        $prospectos = Auth::user()->empleado->prospectosActuales()->whereEstatusVolverALlamar()->get();
        // $prospectos = Prospecto::whereEstatusVolverALlamar()->get();
        $resultados_llamadas = ResultadoLlamada::get();

        return view('prospectos.volver_a_llamar.index', compact('prospectos', 'resultados_llamadas'));
    }

    public function store(Request $request)
    {
        $storeVolverALlamarService = new StoreVolverALlamarService($request);
        return redirect()->back();
    }
}
