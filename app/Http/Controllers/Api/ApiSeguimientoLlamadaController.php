<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Prospecto;
use App\ResultadoLlamada;
use App\SeguimientoLlamadas;

class ApiSeguimientoLlamadaController extends Controller
{
    public function store(Request $request)
    {
        $prospecto = Prospecto::find($request->prospectoId);
        $resultadoLLamada = ResultadoLlamada::find($request->estatus);

        try {
            SeguimientoLlamadas::create([
                'asesor_id' => $prospecto->asesor()->first()->id,
                'prospecto_id' => $prospecto->id,
                'resultado_llamada_id' => $resultadoLLamada->id,
                'fecha_siguiente_contacto' => $request->fechaSeguimiento,
                'fecha_contacto' => date('Y-m-d'),
                'comentario' => $request->comentario
            ]);

            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
