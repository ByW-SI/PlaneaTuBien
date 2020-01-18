<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Prospecto;
use App\ResultadoLlamada;
use App\SeguimientoLlamadas;
use App\Services\SeguimientoLlamada\StoreSeguimientoLlamadaService;

class ApiSeguimientoLlamadaController extends Controller
{
    public function store(Request $request)
    {
        $storeSeguimientoLlamadaService = new StoreSeguimientoLlamadaService($request);
        return response()->json( $storeSeguimientoLlamadaService->getResponse() );
    }
}
