<?php

namespace App\Services\SeguimientoLlamada;

use App\Prospecto;
use App\ResultadoLlamada;
use Illuminate\Support\Facades\Auth;

class IndexSeguimientoLlamadaService
{
    protected $seguimientoLlamadas;
    protected $estatusLlamada;
    protected $prospectos;
    protected $empleado;

    public function __construct()
    {
        $this->empleado = Auth::user()->empleado;
        $this->estatusLlamada = ResultadoLlamada::get();

        $this->setProspectos();
        $this->seguimientoLlamadas = $this->getSeguimientoLlamadaProspectos($this->prospectos);
    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function setProspectos()
    {
        if ($this->empleado->esAdmin()) {
            $this->prospectos = Prospecto::where('estatus_id',1)
                ->has('asesores')
                ->has('asesor')
                ->get();
            return;
        }
        $this->prospectos = $this->empleado
            ->prospectos()
            ->where('estatus_id',1)
            ->has('asesores')
            ->has('asesor')
            ->get();
    }

    public function getProspectosXEstatus($estatus_id)
    {
        // OBTENEMOS AL EMPLEADO
        $this->empleado = Auth::user()->empleado;

        // SI ES ADMIN OBTENEMOS TODOS LOS PROSPECTOS. SI NO, SOLO LOS PROSPECTOS DEL EMPLEADO.
        if ($this->empleado->tipo == 'Admin') {
            $this->prospectos = Prospecto::where('estatus_id', '1')->get();
        } else {
            $this->prospectos = $this->empleado->prospectos()->where('estatus_id', $estatus_id)->get();
        }

        return $this->prospectos;
    }

    public function getSeguimientoLlamadaProspectos($prospectos)
    {
        $this->seguimientoLlamadas = [];

        // Obtenemos los registros de las llamadas de cada prospecto, solo los ultimos 4
        foreach ($this->prospectos as $key => $prospecto) {
            $aux = [];
            $segLlamada = $prospecto->seguimientoLlamadas()->orderBy('id','desc')->get();

            for ($i = 0; $i < 4; $i++) {
                if (isset($segLlamada[$i])) {
                    //dd($segLlamada[$i]->resultado_llamada_id);
                    $aux[] = [
                        $segLlamada[$i]->fecha_contacto,
                        ResultadoLlamada::find($segLlamada[$i]->resultado_llamada_id)->codigo,
                        $segLlamada[$i]->fecha_siguiente_contacto
                    ];
                } else {
                    $aux[] = [
                        '',
                        '',
                        ''
                    ];
                }
            }
            $this->seguimientoLlamadas[] = $aux;
        }

        return $this->seguimientoLlamadas;
    }

    /**
     * =======
     * GETTERS
     * =======
     */

    public function getEmpleado()
    {
        return $this->empleado;
    }

    public function getProspectos()
    {
        return $this->prospectos;
    }

    public function getEstastusLlamada()
    {
        return $this->estatusLlamada;
    }

    public function getSeguimientoLLamadas()
    {
        return $this->seguimientoLlamadas;
    }
}
