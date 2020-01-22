<?php

namespace App\Services\Cita;

use App\CitaCancelada;
use App\EstatusProspecto;
use App\Prospecto;
use App\SeguimientoLlamadas;
use Carbon\Carbon;

class UpdateCitaService
{

    protected $request;
    protected $route;

    protected $cita;
    protected $prospecto;
    protected $asesor;
    protected $seguimientoLLamada;

    public function __construct($request, $cita)
    {
        $this->setCita($cita);
        $this->setProspecto($cita);
        $this->setAsesor($this->prospecto);
        $this->setRequest($request);

        $this->actualizarProspecto($request);

        if ($this->confirmoCita()) {
            $this->actualizarEstatusProspecto('Cita Confirmada');
            $this->confirmarCita();
            $this->establecerRutaDeCitasConfirmadas();
        }

        if ($this->reagendoCita()) {

            if (!$this->tieneFechaLaNuevaCita()) {
                $this->actualizarEstatusProspecto('Pendiente');
            }

            $this->actualizarFechaCita();
            $this->establecerRutaDeCitas();
        }

        if ($this->reagendoLlamada()) {
            $this->reagendarLLamada();
            $this->actualizarEstatusProspecto('Reagendar cita');
            $this->establecerRutaDeCitasReprogramables();
        }

        if ($this->canceloCita()) {
            $this->crearCitaCancelada();
            $this->actualizarEstatusProspecto('Cita Cancelada');
            $this->establecerRutaDeCitasCanceladas();
        }
        // dd('doesnt work');
    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function crearCitaCancelada()
    {
        $this->citaCancelada = CitaCancelada::create([
            'cita_id' => $this->cita->id,
            'comentario' => $this->request->comentarioCancelacion,
            'asesor_confirmador_id' => $this->request->idAsesorQueConfirma,
            'tipo_cancelacion' => $this->request->opcionCancelacion,
        ]);
    }

    public function reagendarLlamada()
    {
        $this->seguimientoLLamada = SeguimientoLlamadas::create([
            'asesor_id' => $this->asesor->id,
            'prospecto_id' => $this->prospecto->id,
            'resultado_llamada_id' => 4,
            'fecha_contacto' => Carbon::now(),
            'fecha_siguiente_contacto' => $this->request->nuevaFechaLlamada,
            'comentario' => 'Reprogramar cita',
        ]);
    }

    public function establecerRutaDeCitasCanceladas()
    {
        $this->route = 'citas.canceladas.index';
    }

    public function establecerRutaDeCitasReprogramables()
    {
        $this->route = 'citas.reprogramables.index';
    }

    public function establecerRutaDeCitas()
    {
        $this->route = 'citas.index';
    }

    public function establecerRutaDeCitasConfirmadas()
    {
        $this->route = 'citas.confirmadas';
    }

    public function actualizarFechaCita()
    {
        $this->cita->update([
            'fecha_cita' => $this->request->nuevaFechaCita,
        ]);
    }

    public function confirmarCita()
    {
        $this->cita->update([
            'esta_confirmada' => 1,
        ]);
    }

    public function actualizarEstatusProspecto($nombreEstatus)
    {
        $this->prospecto->update([
            'estatus_id' => EstatusProspecto::where('nombre', $nombreEstatus)->first()->id
        ]);
    }

    // public function prospectoA

    public function actualizarCita()
    {
        $this->cita->update([
            'fecha_cita' => $this->request->nuevaFechaCita,
        ]);
    }

    public function actualizarProspecto($request)
    {
        $this->prospecto->update([
            'nombre' => $request->nombre,
            'appaterno' => $request->appaterno,
            'apmaterno' => $request->apmaterno,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'celular' => $request->celular,
        ]);
    }

    public function confirmarCitaAProspecto()
    {
        $this->prospecto->update([
            'estatus_id' => EstatusProspecto::where('nombre', 'Cita Confirmada')->first()->id,
        ]);
    }

    /**
     * =======
     * GETTERS
     * =======
     */

    public function getRoute()
    {
        return $this->route;
    }

    /**
     * =======
     * SETTERS
     * =======
     */

    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function setProspecto($cita)
    {
        $this->prospecto = $cita->prospecto;
    }

    public function setCita($cita)
    {
        $this->cita = $cita;
    }

    public function setAsesor($prospecto)
    {
        $this->asesor = $this->prospecto->asesor;
    }

    /**
     * ========
     * BOOLEANS
     * ========
     */

    public function confirmoCita()
    {
        return $this->request->accion == 'confirmar cita';
    }

    public function reagendoCita()
    {
        return $this->request->accion == 'reagendar cita';
    }

    public function reagendoLlamada()
    {
        return $this->request->accion == 'llamar para reagendar';
    }

    public function canceloCita()
    {
        return $this->request->accion == 'cancelar cita';
    }

    public function tieneFechaLaNuevaCita()
    {
        return $this->request->nuevaFechaCita ? true : false;
    }
}
