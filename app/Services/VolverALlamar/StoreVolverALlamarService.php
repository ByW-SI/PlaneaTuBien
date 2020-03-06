<?php

namespace App\Services\VolverALlamar;

use App\CitaCancelada;
use App\Citas;
use App\EstatusProspecto;
use App\Prospecto;
use App\SeguimientoLlamadas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StoreVolverALlamarService
{

    protected $request;

    protected $prospecto;
    protected $seguimientoLLamada;
    protected $cita;

    public function __construct($request)
    {
        $this->setRequest($request);
        $this->setProspecto($request);
        $this->setCita();

        if ($this->solicitoOtraLlamada()) {
            $this->reagendarLlamada();
        }

        if ($this->canceloCita()) {
            if (!$this->prospecto->tieneCita()) {
                $this->crearCita();
            }
            $this->crearCitaCancelada();
            $this->actualizarStatusProspecto('Cita Cancelada');
        }
    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function actualizarStatusProspecto($nombreStatus)
    {
        $this->prospecto->update([
            'estatus_id' => EstatusProspecto::where('nombre', $nombreStatus)->first()->id,
        ]);
    }

    public function crearCita()
    {
        $this->cita = Citas::create([
            'prospecto_id' => $this->prospecto->id,
            'clave_preautorizacion' => '',
            'fecha_cita' => null,
            'hora' => null
        ]);
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

    public function reagendarLlamada()
    {

        $this->seguimientoLLamada = SeguimientoLlamadas::create([
            'asesor_id' => $this->prospecto->asesor->id,
            'prospecto_id' => $this->prospecto->id,
            'resultado_llamada_id' => 4,
            'fecha_contacto' => Carbon::now(),
            'fecha_siguiente_contacto' => $this->request->fecha_siguiente_contacto,
            'comentario' => $this->request->comentario,
        ]);
    }

    /**
     * ========
     * BOOLEANS
     * ========
     */

    public function solicitoOtraLlamada()
    {
        return $this->request->accion == 'VOLVER A LLAMAR';
    }

    public function canceloCita()
    {
        return $this->request->accion == 'CANCELAR CITA';
    }

    /**
     * =======
     * SETTERS
     * =======
     */

    public function setProspecto($request)
    {
        $this->prospecto = Prospecto::find($request->prospecto_id);
    }

    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function setCita()
    {
        $this->cita = $this->prospecto->citas()->first();
    }
}
