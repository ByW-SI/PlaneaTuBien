<?php

namespace App\Services\Cita;

use App\Citas;
use App\EstatusProspecto;
use App\SeguimientoLlamadas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UpdateCitaConfirmadaService
{

    protected $cita;
    protected $prospecto;
    protected $seguimientoLLamada;

    public function __construct(Citas $cita)
    {
        $this->setCita($cita);
        $this->setProspecto($cita->prospecto);
        $this->setAsesor($this->prospecto->asesor);

        if ($this->noAsistio()) { // AUN NO ESTÁ IMPLEMENTADO
            $this->actualizarEstatusProspecto('Reagendar cita');
        }
    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function reagendarLlamada()
    {
        $this->seguimientoLLamada = SeguimientoLlamadas::create([
            'asesor_id' => $this->asesor->id,
            'prospecto_id' => $this->prospecto->id,
            'resultado_llamada_id' => 4,
            'fecha_contacto' => Carbon::now(),
            'fecha_siguiente_contacto' => date('Y-m-d'),
            'comentario' => 'No asistió',
        ]);
    }

    public function actualizarEstatusProspecto($nombreEstatus)
    {
        $this->prospecto->update([
            'estatus_id' => EstatusProspecto::where('nombre', $nombreEstatus)->first()->id
        ]);
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

    public function setAsesor($asesor)
    {
        $this->asesor = $asesor;
    }

    /**
     * ========
     * BOOLEANS
     * ========
     */

    public function noAsistio()
    {
        return true;
    }
}
