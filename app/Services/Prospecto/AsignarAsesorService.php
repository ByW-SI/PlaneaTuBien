<?php

namespace App\Services\Prospecto;

use App\Empleado;
use App\Prospecto;
use Illuminate\Http\Request;

class AsignarAsesorService
{

    protected $prospectos;
    protected $asesor;

    public function __construct(Request $request)
    {
        $asesor = Empleado::find($request->asesor);
        foreach ($request->prospectos as $prospecto) {
            $prospecto = Prospecto::find($prospecto);
            
            if(!$asesor->tieneProspecto($prospecto)){
                $prospecto->asesores()->attach($asesor, ['activo' => 1, 'temporal' => 0]);
                // Se asigna el estatus en seguimiento llamada
                $prospecto->estatus()->associate(1);
                $prospecto->save();
                $prospecto->update([
                    'empleado_id' => $asesor->id,
                ]);
            }
            
        }
    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function asignarStatusSeguimientoLLamadaAProspecto($prospecto)
    {
        // Se asigna el estatus en seguimiento llamada
        $prospecto->estatus()->associate(1);
        $prospecto->save();
    }

    public function quitarAsesoresAProspecto($prospecto)
    {
        $prospecto->detach();
        $prospecto->update([
            'empleado_id' => null,
        ]);
    }

    public function asignarAsesorAProspecto($prospecto)
    {
        $prospecto->asesores()->attach($this->asesor, ['activo' => 1, 'temporal' => 0]);
        $prospecto->update([
            'empleado_id' => $this->asesor->id,
        ]);
        $prospecto->save();
    }

    /**
     * =======
     * SETTERS
     * =======
     */

    public function setAsesor($request)
    {
        $this->asesor = Empleado::find($request->asesor);
    }

    /**
     * =======
     * GETTERS
     * =======
     */

    public function getProspectos()
    {
        return $this->prospectos;
    }
}
