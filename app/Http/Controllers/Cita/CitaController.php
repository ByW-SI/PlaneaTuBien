<?php

namespace App\Http\Controllers\Cita;

use App\Citas;
use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Prospecto;
use App\SeguimientoLlamadas;
use App\Services\Cita\StoreCitaService;
use App\Services\Cita\UpdateCitaService;

class CitaController extends Controller
{

    public function index()
    {
        $citas = Citas::noConfirmadas()->get();
        $asesores = Empleado::asesores()->get();
        return view('citas.index', compact('citas', 'asesores'));
    }

    public function store(Request $request)
    {
        $storeCitaService = new StoreCitaService($request);
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $cita = Citas::find($id);
        $updateCitaService = new UpdateCitaService($request, $cita);
        return redirect()->route($updateCitaService->getRoute());
    }

    public function confirmadas()
    {
        $citas = Citas::confirmadas()->get();
        return view('citas.confirmadas.index', compact('citas'));
    }

    public function reprogramables()
    {
        $citas = null;
        $seguimientoLLamadas = SeguimientoLlamadas::where('comentario', 'Reprogramar cita')->get();

        if ($seguimientoLLamadas) {
            $citas = $seguimientoLLamadas->pluck('prospecto')->flatten()->pluck('citas')->flatten()->where('esta_confirmada', 0)->unique();
        }

        return view('citas.reprogramables.index', compact('citas'));
    }

    public function canceladas()
    {
        $citas = Citas::has('citaCancelada')->get();
        return view('citas.canceladas.index', compact('citas'));
    }
}
