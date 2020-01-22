<?php

namespace App\Services\Cita;

use App\Citas;
use App\EstatusProspecto;

class ReactivarCitaService
{

    protected $cita;
    protected $prospecto;

    public function __construct(Citas $cita)
    {
        $this->setCita($cita);
        $this->setProspecto($cita->prospecto);

        $this->actualizarEstatusProspecto('Seguimiento Llamada');
        $this->eliminarCitaCancelada();
        $this->eliminarCitas();
    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function actualizarEstatusProspecto($nombreEstatus)
    {
        $this->prospecto->update([
            'estatus_id' => EstatusProspecto::where('nombre', $nombreEstatus)->first()->id
        ]);
    }

    public function eliminarCitaCancelada()
    {
        $this->cita->citaCancelada->delete();
    }

    public function eliminarCitas(){
        $this->cita = $this->prospecto->citas()->delete();
    }

    /**
     * =======
     * SETTERS
     * =======
     */

    public function setCita($cita)
    {
        $this->cita = $cita;
    }

    public function setProspecto($prospecto)
    {
        $this->prospecto = $prospecto;
    }
}
