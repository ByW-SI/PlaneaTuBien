<?php

namespace App\Services\Cita;

use App\Citas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexCitaPendienteService
{

    protected $citas;

    public function __construct(Request $request)
    {
        $this->setCitas();
        $this->filtrarCitasPorUsuarioEnSesion();
        $this->filtrarCitasPorFechaDeInicio($request->fechaCitaInicio);
        $this->filtrarCitasPorFechaDeFin($request->fechaCitaFin);
    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function filtrarCitasPorUsuarioEnSesion()
    {
        $idsProspectosActuales = Auth::user()->empleado->prospectosActuales()->get()->pluck('id')->toArray();
        $this->citas = $this->citas->whereIn('prospecto_id',$idsProspectosActuales);
    }

    public function filtrarCitasPorFechaDeInicio($fecha)
    {
        $this->citas = is_null($fecha)
            ? $this->citas
            : $this->citas->where('fecha_cita', '>=', $fecha);
    }

    public function filtrarCitasPorFechaDeFin($fecha)
    {
        $this->citas = is_null($fecha)
            ? $this->citas
            : $this->citas->where('fecha_cita', '<=', $fecha);
    }

    public function setCitas()
    {
        $this->citas = Citas::whereHas('prospecto', function ($query) {
            return $query->whereEstatusPendiente();
        })->with('prospecto.estatus')->get();
    }

    public function getCitas()
    {
        return $this->citas;
    }
}
