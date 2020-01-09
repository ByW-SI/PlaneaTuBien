<?php

namespace App\Services\Cita;

use App\Citas;
use App\EstatusProspecto;
use App\Prospecto;
use Illuminate\Http\Request;

class StoreCitaService
{

    protected $cita;
    protected $prospecto;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->crearCita($request);
        $this->setProspecto($request);
        $this->actualizarProspecto($request);

        if ($this->estaDefinidaLaFechaDeCita()) {
            $this->actualizarStatusProspecto('Cita');
        } else {
            dd('no esta definida');
            $this->actualizarStatusProspecto('Pendiente');
        }
    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function actualizarProspecto($request)
    {
        $this->prospecto->update([
            'numeroTarjetas' => $request->numeroTarjeta,
            'sueldo' => $request->sueldo,
            'estado_civil' => $request->estado_civil,
            'nombreConyuge' => $request->nombreConyuge,
            'edadConyuge' => $request->edadConyuge,
            'edad' => $request->edad,
            'montoProyecto' => $request->montoProyecto,
            'celular_2' => $request->celular_2,
            'telefonoOficina' => $request->telefonoOficina,
            'telefonoConyugue' => $request->telefonoConyugue,
            'telefonoCasa' => $request->telefonoCasa,
            'email_2' => $request->email_2
        ]);
    }

    public function crearCita(Request $request)
    {
        $this->cita = Citas::create([
            'prospecto_id' => $request->prospecto_id,
            'clave_preautorizacion' => $request->clave_preautorizacion,
            'fecha_cita' => $request->fecha_cita,
        ]);
    }

    public function actualizarStatusProspecto($nombreStatus)
    {
        $this->prospecto->update([
            'estatus_id' => EstatusProspecto::where('nombre', $nombreStatus)->first()->id,
        ]);
    }

    /**
     * ========
     * BOOLEANS
     * ========
     */

    public function estaDefinidaLaFechaDeCita()
    {
        return !is_null($this->request->fecha_cita) ? true : false;
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
}
