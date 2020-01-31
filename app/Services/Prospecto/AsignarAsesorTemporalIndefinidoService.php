<?php

namespace App\Services\Prospecto;

use App\Empleado;
use App\Prospecto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AsignarAsesorTemporalIndefinidoService
{

    public function __construct(Request $request)
    {
        $this->setProspectos($request);
        $this->setAsesor($request);

        foreach ($this->prospectos as $prospecto) {
            $this->asignarAsesorTemporal($prospecto);
        }
    }

    /**
     * =======
     * METHODS
     * =======
     */

    private function asignarAsesorTemporal($prospecto)
    {
        $prospecto->asesores()->attach(
            $this->asesor->id,
            [
                'temporal' => 1,
                'activo' => 1,
                'fechaInicioTemporal' => Carbon::now(),
                'fechaFinTemporal' => null,
            ]
        );
    }

    /**
     * =======
     * SETTERS
     * =======
     */

    public function setProspectos($request)
    {
        $this->prospectos = Prospecto::find($request->prospectos);
    }

    public function setAsesor($request)
    {
        $this->asesor = Empleado::find($request->asesor);
    }
}
