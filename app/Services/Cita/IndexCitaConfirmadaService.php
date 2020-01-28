<?php

namespace App\Services\Cita;

use App\Citas;
use Illuminate\Http\Request;

class IndexCitaConfirmadaService
{

    protected $citas;

    public function __construct(Request $request)
    {
        $this->setCitas();
        $this->filtrarCitasPorFechaDeInicio($request->fechaCitaInicio);
    }

    /**
     * =======
     * METHODS
     * =======
     */

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

    /**
     * =======
     * SETTERS
     * =======
     */

    public function setCitas()
    {
        $this->citas = Citas::confirmadas()->get();
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
