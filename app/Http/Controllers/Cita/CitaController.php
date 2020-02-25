<?php

namespace App\Http\Controllers\Cita;

use App\Citas;
use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Cita\AsistirCitaService;
use App\Services\Cita\IndexCitaCanceladaService;
use App\Services\Cita\IndexCitaConfirmadaService;
use App\Services\Cita\IndexCitaPendienteService;
use App\Services\Cita\IndexCitaReprogramableService;
use App\Services\Cita\IndexCitaService;
use App\Services\Cita\ReactivarCitaService;
use App\Services\Cita\StoreCitaService;
use App\Services\Cita\UpdateCitaConfirmadaService;
use App\Services\Cita\UpdateCitaPendienteService;
use App\Services\Cita\UpdateCitaService;

class CitaController extends Controller
{

    public function index(Request $request)
    {
        $indexCitaService = new IndexCitaService($request);
        $citas = $indexCitaService->getCitas();
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

    public function confirmadas(Request $request)
    {
        $indexCitaConfirmadaService = new IndexCitaConfirmadaService($request);
        $citas = $indexCitaConfirmadaService->getCitas();
        $asesores = Empleado::asesores()->get();
        return view('citas.confirmadas.index', compact('citas', 'asesores'));
    }

    public function reprogramables(Request $request)
    {
        $indexCitaReprogramableService = new IndexCitaReprogramableService($request);
        $citas = $indexCitaReprogramableService->getCitas();
        return view('citas.reprogramables.index', compact('citas'));
    }

    public function canceladas(Request $request)
    {
        $indexCitaCanceladaService = new IndexCitaCanceladaService($request);
        $citas = $indexCitaCanceladaService->getCitas();
        return view('citas.canceladas.index', compact('citas'));
    }

    public function reactivar(Citas $citas)
    {
        $reactivarCitaService = new ReactivarCitaService($citas);
        return redirect()->route('seguimiento.llamadas.index');
    }

    public function pendientes(Request $request)
    {
        $indexCitaPendienteService = new IndexCitaPendienteService($request);
        $citas = $indexCitaPendienteService->getCitas();

        $asesores = Empleado::asesores()->get();

        return view('citas.pendientes.index', compact('citas', 'asesores'));
    }

    public function pendientesReprogramar()
    {
        $citas = Citas::whereHas('prospecto', function ($query) {
            return $query->whereEstatusCitaPendienteReprogramar();
        })->get();
        return view('citas.pendientes.reprogramar.index', compact('citas'));
    }

    public function updatePendientes(Request $request, Citas $citas)
    {
        $updateCitaPendienteService = new UpdateCitaPendienteService($request, $citas);
        return redirect()->route($updateCitaPendienteService->getRoute());
    }

    public function confirmadasUpdate(Request $request, Citas $citas)
    {
        $updateCitaConfirmadaService = new UpdateCitaConfirmadaService($citas);
        return redirect()->back();
    }

    public function asistir(Request $request, Citas $citas)
    {
        $asistirCitaService = new AsistirCitaService($request, $citas);
        // dd($citas->prospecto->id);
        $asistirCitaService->getRoute();

        if ($request->accion == 'CREAR COTIZACION') {
            return redirect()->route('empleados.prospectos.cotizacions.create', ['empleado' => $citas->prospecto->asesor->id, 'prospecto' => $citas->prospecto->id]);
        } else {
            return redirect()->route('crear-perfil-sin-cotizacion', ['prospecto' => $citas->prospecto->id]);
        }
    }
}
