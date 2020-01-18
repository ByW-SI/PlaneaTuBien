<?php

namespace App\Http\Controllers\Cita;

use App\Citas;
use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Prospecto;
use App\SeguimientoLlamadas;
use App\Services\Cita\StoreCitaService;
use App\Services\Cita\UpdateCitaPendienteService;

class CitaController extends Controller
{

    public function index()
    {
        $citas = Citas::noCanceladas()->whereHas('prospecto', function ($query) {
            return $query->whereEstatusCita();
        })->get();

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
        $citas = Citas::whereHas('prospecto', function ($query) {
            return $query->whereHas('estatus', function ($query) {
                return $query->where('nombre', 'Reagendar cita');
            });
        })->get();

        return view('citas.reprogramables.index', compact('citas'));
    }

    public function canceladas()
    {
        $citas = Citas::whereHas('prospecto', function($query){
            return $query->whereEstatusCitaCancelada();
        })->has('citaCancelada')->get();

        return view('citas.canceladas.index', compact('citas'));
    }

    public function pendientes()
    {

        $citas = Citas::whereHas('prospecto', function ($query) {
            return $query->whereEstatusPendiente();
        })->with('prospecto.estatus')->get();

        // return $citas;

        $asesores = Empleado::asesores()->get();

        return view('citas.pendientes.index', compact('citas', 'asesores'));
    }

    public function updatePendientes(Request $request, Citas $citas)
    {
        $updateCitaPendienteService = new UpdateCitaPendienteService($request, $citas);
        return redirect()->route($updateCitaPendienteService->getRoute());
    }
}
