<?php

namespace App\Services\Prospecto;

use App\CitaCancelada;
use App\EmpleadoProspecto;
use App\Prospecto;

class DestroyProspectoService
{

    protected $prospecto;

    public function __construct(Prospecto $prospecto)
    {
        $this->setProspecto($prospecto);


        // $this->eliminarSeguimientoLlamadas();
        // $this->eliminarCitaCancelada();
        // $this->eliminarCita();
        // $this->eliminarCotizaciones();
        // $this->desasignarAsesores();
        // $this->eliminarProspecto();
        // dd($this->prospecto->seguimientoLlamadas()->get());
        dd(EmpleadoProspecto::where('prospecto_id',$this->prospecto->id)->update([
            'empleado_id' => null
        ]));
        dd(EmpleadoProspecto::where('prospecto_id',$this->prospecto->id)->get());
        dd($this->prospecto->asesores);
    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function desasignarAsesores()
    {
        $this->prospecto->asesores()->detach($this->prospecto->id);
    }

    public function eliminarCotizaciones()
    {
        $this->prospecto->cotizaciones()->delete();
    }

    public function eliminarSeguimientoLlamadas()
    {
        $this->prospecto->seguimientoLlamadas()->delete();
    }

    public function eliminarCitaCancelada()
    {
        CitaCancelada::whereIn('id', $this->prospecto->citas->pluck('citaCancelada')->flatten()->pluck('id')->flatten())->delete();
    }

    public function eliminarCita()
    {
        $this->prospecto->citas()->delete();
    }

    public function eliminarProspecto()
    {
        $this->prospecto->delete();
    }

    /**
     * =======
     * SETTERS
     * =======
     */

    public function setProspecto(Prospecto $prospecto)
    {
        $this->prospecto = $prospecto;
    }
}
