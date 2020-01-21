<?php

namespace App\Services\SeguimientoLlamada;

use App\CitaCancelada;
use App\Citas;
use App\EstatusProspecto;
use App\Prospecto;
use App\ResultadoLlamada;
use App\SeguimientoLlamadas;
use Illuminate\Http\Request;

class StoreSeguimientoLlamadaService
{

    protected $request;
    protected $response;

    protected $cita;
    protected $citaCancelada;

    protected $prospecto;
    protected $resultadoLLamada;
    protected $seguimientoLlamada;

    public function __construct(Request $request)
    {
        $this->setRequest($request);
        $this->prospecto = Prospecto::find($request->prospectoId);
        $this->resultadoLLamada = ResultadoLlamada::find($request->estatus);



        try {
            $this->crearSeguimientoLlamada();

            if ($this->clienteNoApto()) {
                $this->crearCita();
                $this->crearCitaCancelada();
                $this->actualizarEstatusProspecto('Cita Cancelada');
            }

            if ($this->requiereCitaPendiente()) {
                $this->crearCita();
                $this->actualizarEstatusProspecto('Pendiente');
            }
            
            if ($this->requiereVolverALlamar()) {
                $this->actualizarEstatusProspecto('Volver A Llamar');
            }

            // $this->setResponse($this->cita->toArray());
        } catch (\Exception $e) {
            $this->setResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
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

    public function crearSeguimientoLlamada()
    {
        $this->seguimientoLlamada = SeguimientoLlamadas::create([
            'asesor_id' => $this->prospecto->asesor()->first()->id,
            'prospecto_id' => $this->prospecto->id,
            'resultado_llamada_id' => $this->resultadoLLamada->id,
            'fecha_siguiente_contacto' => $this->request->fechaSeguimiento,
            'fecha_contacto' => date('Y-m-d'),
            'comentario' => $this->request->comentario
        ]);
    }

    public function crearCita()
    {
        $this->cita = Citas::create([
            'prospecto_id' => $this->prospecto->id,
            'clave_preautorizacion' => '',
        ]);
    }

    public function crearCitaCancelada()
    {
        $this->citaCancelada = CitaCancelada::create([
            'cita_id' => $this->cita->id,
        ]);
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

    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * =======
     * GETTERS
     * =======
     */

    public function getResponse()
    {
        return $this->response;
    }

    /**
     * ========
     * BOOLEANS
     * ========
     */

    public function requiereVolverALlamar()
    {
        return $this->resultadoLLamada->nombre == 'Volver a llamar';
    }

    public function clienteNoApto()
    {
        if ($this->resultadoLLamada->nombre == 'Dato Falso') {
            return true;
        }
        if ($this->resultadoLLamada->nombre == 'No interesa') {
            return true;
        }
        if ($this->resultadoLLamada->nombre == 'Dato repetido') {
            return true;
        }
        if ($this->resultadoLLamada->nombre == 'No cubre con perfil') {
            return true;
        }
        return false;
    }

    public function requiereCitaPendiente()
    {
        if ($this->resultadoLLamada->nombre == 'Cita pendiente') {
            return true;
        }
        return false;
    }
}
