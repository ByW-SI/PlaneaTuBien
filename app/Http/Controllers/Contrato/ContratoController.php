<?php

namespace App\Http\Controllers\Contrato;

use App\Contrato;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContratoController extends Controller
{
    public function updateGrupo(Request $request, Contrato $contrato)
    {
        $contrato->update([
            'grupo_id' => $request->nuevoGrupo
        ]);
        return redirect()->back();
    }
}
