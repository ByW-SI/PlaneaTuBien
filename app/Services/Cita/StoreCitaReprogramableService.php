<?php

namespace App\Services\Cita;

use App\CitaCancelada;
use App\Citas;
use App\EstatusProspecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreCitaReprogramableService
{

    protected $request;
    protected $route;

    public function __construct(Request $request, Citas $cita)
    {
        // dd($cita->prospecto);
        // dd($request->input());

        $this->setRequest($request);
        $this->setProspecto($cita->prospecto);
        $this->setCita($cita);

        if ($this->canceloCita()) {
            $this->crearCitaCancelada();
            $this->actualizarEstatusProspecto('Cita Cancelada');
            $this->establecerRutaDeCitasCanceladas();
        }

        if ($this->cambioASeguimientoLlamada()) {
            $this->actualizarEstatusProspecto('Seguimiento Llamada');
            $this->establecerRutaDeSeguimientoLlamadas();
        }
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
            'comentario' => 'Cita cancelada',
            'asesor_confirmador_id' => Auth::user()->id,
            // 'tipo_cancelacion' => $this->request->opcionCancelacion,
        ]);
    }

    public function actualizarEstatusProspecto($nombreEstatus)
    {
        $this->prospecto->update([
            'estatus_id' => EstatusProspecto::where('nombre', $nombreEstatus)->first()->id
        ]);
    }

    public function establecerRutaDeCitasCanceladas()
    {
        $this->route = 'citas.canceladas.index';
    }

    public function establecerRutaDeSeguimientoLlamadas()
    {
        $this->route = 'seguimiento.llamadas.index';
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

    public function setProspecto($prospecto)
    {
        $this->prospecto = $prospecto;
    }

    public function setCita($cita)
    {
        $this->cita = $cita;
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
     * ========
     * BOOLEANS
     * ========
     */

    public function canceloCita()
    {
        return $this->request->accion == 'CANCELAR CITA';
    }

    public function cambioASeguimientoLlamada()
    {
        return $this->request->accion == 'SEGUIMIENTO LLAMADA';
    }
}
