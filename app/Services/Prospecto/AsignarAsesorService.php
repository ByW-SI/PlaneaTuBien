<?php

namespace App\Services\Prospecto;

use App\Empleado;
use App\EmpleadoProspecto;
use App\Prospecto;
use Illuminate\Http\Request;

class AsignarAsesorService
{

    protected $prospectos;
    protected $asesor;

    public function __construct(Request $request)
    {
        $this->setAsesor($request);
        $this->setProspectos($request);

        foreach ($this->prospectos as $prospecto) {
            $this->asignarAsesoresComoTemporales($prospecto);
            $this->asignarNuevoAsesorComoOficial($prospecto);
        }
    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function asignarNuevoAsesorComoOficial($prospecto)
    {
        $prospecto->asesores()->attach($this->asesor, ['activo' => 1, 'temporal' => 0]);
        // $prospecto->estatus()->associate(1);
        $prospecto->save();
        $prospecto->update([
            'empleado_id' => $this->asesor->id,
        ]);
    }

    public function asignarAsesoresComoTemporales($prospecto)
    {
        EmpleadoProspecto::where('prospecto_id', $prospecto->id)->where('temporal', 0)->update([
            'activo' => 0
        ]);
    }

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

    public function setProspectos($request)
    {
        $this->prospectos = Prospecto::whereIn('id', $request->prospectos)->get();
        // foreach ($request->prospectos as $prospecto) {
        //     $prospecto = Prospecto::find($prospecto);
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
