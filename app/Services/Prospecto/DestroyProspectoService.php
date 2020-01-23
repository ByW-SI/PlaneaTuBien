<?php

namespace App\Services\Prospecto;

use App\CitaCancelada;
use App\EmpleadoProspecto;
use App\Prospecto;
use App\SeguimientoLlamadas;

class DestroyProspectoService
{

    protected $prospecto;

    public function __construct(Prospecto $prospecto)
    {
        $this->setProspecto($prospecto);


        $this->eliminarSeguimientoLlamadas();
        $this->eliminarCitaCancelada();
        $this->eliminarCita();
        // $this->eliminarCotizaciones();
        $this->desasignarAsesores();
        // dd($this->prospecto->seguimientoLlamadas()->get());
        // dd(EmpleadoProspecto::where('prospecto_id',$this->prospecto->id)->update([
            //     'empleado_id' => null
        // ]));
        
        // ELIMNACION DE SEGUIMIENTO LLAMADAS
        
        // dd(EmpleadoProspecto::where('prospecto_id',$this->prospecto->id)->get()->pluck('seguimientoLlamadas')->flatten()->pluck('id'));
        
        $this->eliminarProspecto();
        // dd($this->prospecto);
    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function desasignarAsesores()
    {
        $this->prospecto->asesores()->detach($this->prospecto->id);
        EmpleadoProspecto::where('prospecto_id',$this->prospecto->id)->delete();
    }

    public function eliminarCotizaciones()
    {
        $this->prospecto->cotizaciones()->delete();
    }

    public function eliminarSeguimientoLlamadas()
    {
        $this->prospecto->seguimientoLlamadas()->delete();
        SeguimientoLlamadas::whereIn('id', EmpleadoProspecto::where('prospecto_id',$this->prospecto->id)->get()->pluck('seguimientoLlamadas')->flatten()->pluck('id'))->delete();
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
        Prospecto::find($this->prospecto->id)->delete();
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
