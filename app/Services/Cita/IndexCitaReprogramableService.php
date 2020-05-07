<?php

namespace App\Services\Cita;

use App\Citas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexCitaReprogramableService
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
        $this->citas = Citas::whereHas('prospecto', function ($query) {
            return $query->whereHas('estatus', function ($query) {
                return $query->where('nombre', 'Reagendar cita');
            });
        })->get();

        $this->citas = $this->citas->filter( function($cita){
            return Auth::user()->empleado->prospectosActuales()->find($cita->prospecto_id) != null;
        } );
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
