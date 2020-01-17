<?php

namespace App\Services\Cita;

use App\CitaCancelada;
use App\EstatusProspecto;
use App\SeguimientoLlamadas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class updateCitaPendienteService
{

    protected $request;
    protected $route;

    protected $seguimientoLLamada;
    protected $citaCancelada;

    protected $prospecto;
    protected $cita;

    public function __construct(Request $request, $cita)
    {
        $this->setRequest($request);
        $this->setCita($cita);
        $this->setProspecto($cita->prospecto);
        $this->setAsesor($cita->prospecto->asesor);

        if ($this->confirmoFechaCita()) {
            $this->actualizarEstatusProspecto('Cita');
            $this->confirmarCita();
            $this->establecerFechaCita();
            $this->establecerRutaDeCitas();
        }

        if ($this->reagendoLlamada()) {
            $this->reagendarLLamada();
            $this->establecerRutaDeCitasPendientes();
        }

        if ($this->canceloCita()) {
            $this->crearCitaCancelada();
            $this->actualizarEstatusProspecto('Cita Cancelada');
            $this->establecerRutaDeCitasCanceladas();
        }
    }

    /**
     * =======
     * METHODS
     * =======
     */


    public function establecerFechaCita(){
        $this->cita->update([
            'fecha_cita' => $this->request->fechaCita,
        ]);
    }

    public function establecerRutaDeCitas()
    {
        $this->route = 'citas.index';
    }

    public function establecerRutaDeCitasPendientes()
    {
        $this->route = 'citas.pendientes.index';
    }

    public function establecerRutaDeCitasCanceladas()
    {
        $this->route = 'citas.canceladas.index';
    }

    public function crearCitaCancelada()
    {
        $this->citaCancelada = CitaCancelada::create([
            'cita_id' => $this->cita->id,
            'comentario' => $this->request->comentarioCancelacion,
            'asesor_confirmador_id' => $this->request->idAsesorQueConfirma,
            'tipo_cancelacion' => $this->request->opcionCancelacion,
        ]);
    }

    public function actualizarEstatusProspecto($nombreEstatus)
    {
        $this->prospecto->update([
            'estatus_id' => EstatusProspecto::where('nombre', $nombreEstatus)->first()->id
        ]);
    }

    public function confirmarCita()
    {
        $this->cita->update([
            'esta_confirmada' => 1,
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

    public function confirmoFechaCita()
    {
        return $this->request->accion == 'CONFIRMAR FECHA';
    }

    public function reagendoLlamada()
    {
        return $this->request->accion == 'REAGENDAR LLAMADA';
    }

    public function canceloCita()
    {
        return $this->request->accion == 'CANCELAR CITA';
    }
}
