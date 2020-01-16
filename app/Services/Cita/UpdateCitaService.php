<?php

namespace App\Services\Cita;

use App\EstatusProspecto;
use App\Prospecto;

class UpdateCitaService
{

    protected $request;
    protected $cita;
    protected $prospecto;

    public function __construct($request, $cita)
    {
        $this->setCita($cita);
        $this->setProspecto($cita);
        $this->setRequest($request);
        $this->actualizarProspecto($request);

        if ($this->confirmoCita()) {
            $this->actualizarEstatusProspecto('Cita Confirmada');
            $this->confirmarCita();
        }

        if ($this->reagendoCita()) {
            $this->actualizarEstatusProspecto('Cita Pendiente Reprogramar');
        }

        if($this->reagendoLlamada()){
            // $this->prospectoACitaPendiente();
        }
    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function confirmarCita(){
        $this->cita->update([
            'esta_confirmada' => 1,
        ]);
    }

    public function actualizarEstatusProspecto($nombreEstatus){
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

    public function setCita($cita){
        $this->cita = $cita;
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

    public function reagendoLlamada(){
        return $this->request->accion == 'llamar para reagendar';
    }
}
