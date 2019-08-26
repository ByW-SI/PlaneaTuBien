<?php

namespace App\Http\Controllers\Cliente;

use App\Contrato;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Presolicitud;

class ClienteContratosController extends Controller
{
    public function index(Request $request, $id){
        $presolicitud = Presolicitud::find($id);
        $contratos = Contrato::where('presolicitud_id',$presolicitud->id)->get();
        return view('pagos.asignar.contratos', compact('contratos'));
    }
}
