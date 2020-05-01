<?php

namespace App\Services\Cita;

use App\Citas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexCitaService
{

    protected $citas;

    public function __construct(Request $request)
    {
        $this->setCitas();
        $this->filtrarCitasPorUsuarioEnSesion();
        $this->filtrarCitasPorFechaDeInicio($request->fechaCitaInicio);
        $this->filtrarCitasPorFechaDeFin($request->fechaCitaFin);
        // dd($request->fechaCitaInicio);
    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function filtrarCitasPorUsuarioEnSesion()
    {
        $idsProspectosActuales = Auth::user()->empleado->prospectosActuales()->get()->pluck('id')->toArray();
        // dd($idsProspectosActuales);
        $this->citas = $this->citas->whereIn('prospecto_id', $idsProspectosActuales);
    }

    public function filtrarCitasPorFechaDeInicio($fecha)
    {
        $this->citas = is_null($fecha)
            ? $this->citas
            : $this->citas->where('fecha_cita', '>=', $fecha);
        // dd($this->citas);
    }

    public function filtrarCitasPorFechaDeFin($fecha)
    {
        $this->citas = is_null($fecha)
            ? $this->citas
            : $this->citas->where('fecha_cita', '<=', $fecha);
        // dd($this->citas);
    }

    /**
     * =======
     * SETTERS
     * =======
     */

    public function setCitas()
    {
        $this->citas = Citas::noCanceladas()->whereHas('prospecto', function ($query) {
            return $query->whereEstatusCita();
        })->get();
    }

    /**
     * =======
     * GETTERS
     * =======
     */

    public function getCitas()
    {
        return $this->citas;
    }
}
