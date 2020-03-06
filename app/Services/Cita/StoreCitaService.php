<?php

namespace App\Services\Cita;

use App\Citas;
use App\EstatusProspecto;
use App\Prospecto;
use App\SeguimientoLlamadas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreCitaService
{

    protected $cita;
    protected $prospecto;
    protected $request;

    protected $seguimientoLlamada;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->setProspecto($request);

        // dd($this->estaDefinidaLaFechaDeCita());
        
        if($this->prospecto->tieneCita()){
            $this->actualizarCita($this->prospecto);
        }else{
            $this->crearCita($request);
        }

        // dd($this->cita);
        $this->actualizarProspecto($request);

        if ($this->estaDefinidaLaFechaDeCita()) {
            $this->actualizarStatusProspecto('Cita');
        } else {
            $this->agendarNuevaLlamada($request);
            $this->actualizarStatusProspecto('Pendiente');
        }

        // dd($this->prospecto->citas);
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
            'hora' => $request->hora
        ]);
    }

    public function actualizarStatusProspecto($nombreStatus)
    {
        $this->prospecto->update([
            'estatus_id' => EstatusProspecto::where('nombre', $nombreStatus)->first()->id,
        ]);
    }

    public function agendarNuevaLlamada($request){
        $this->seguimientoLlamada=SeguimientoLlamadas::create([
            'asesor_id' => $this->prospecto->asesor->id,
            'prospecto_id' => $this->prospecto->id,
            'resultado_llamada_id' => 9,
            'fecha_siguiente_contacto' => $request->fecha_llamada,
            'fecha_contacto' => date('Y-m-d'),
            'comentario' => 'Pendiente por definir fecha de cita',
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

    public function actualizarCita($prospecto){
        $this->cita = $prospecto->citas()->first()->update([
            'clave_preautorizacion' => $this->request->clave_preautorizacion,
            'fecha_cita' => $this->request->fecha_cita,
            'hora' => $this->request->hora
        ]);
    }

    public function setProspecto($request)
    {
        $this->prospecto = Prospecto::find($request->prospecto_id);
    }
}
