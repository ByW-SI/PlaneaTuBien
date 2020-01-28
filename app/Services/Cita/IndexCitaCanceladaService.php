<?php

namespace App\Services\Cita;

use App\Citas;
use Illuminate\Http\Request;

class IndexCitaCanceladaService
{

    protected $citas;

    public function __construct(Request $request)
    {
        $this->setCitas();
        $this->filtrarCitasPorFechaDeInicio($request->fechaCitaInicio);
        $this->filtrarCitasPorFechaDeFin($request->fechaCitaFin);
    }

    /**
     * =======
     * METHODS
     * =======
     */

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
