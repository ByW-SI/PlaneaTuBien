<?php

namespace App\Services\Cita;

use App\Citas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexCitaCanceladaService
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
        $this->citas = $this->citas->whereIn('prospecto_id', $idsProspectosActuales);
    }

    public function filtrarCitasPorFechaDeInicio($fecha)
    {
        if (is_null($fecha)) {
            return;
        }

        $this->citas = $this->citas->filter(function ($cita) use ($fecha) {
            return $cita->citaCancelada->created_at >= $fecha;
        });
    }

    public function filtrarCitasPorFechaDeFin($fecha)
    {
        if (is_null($fecha)) {
            return;
        }

        $this->citas = $this->citas->filter(function ($cita) use ($fecha) {
            return $cita->citaCancelada->created_at <= $fecha;
        });
    }

    /**
     * =======
     * SETTERS
     * =======
     */

    public function setCitas()
    {
        $this->citas = Citas::whereHas('prospecto', function ($query) {
            return $query->whereEstatusCitaCancelada();
        })->has('citaCancelada')->get();
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
