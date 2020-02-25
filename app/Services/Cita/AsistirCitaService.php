<?php

namespace App\Services\Cita;

use App\Citas;
use App\Empleado;
use Illuminate\Http\Request;

class AsistirCitaService
{

    protected $cita;
    protected $prospecto;
    
    protected $nuevoAsesor;

    protected $route;

    public function __construct(Request $request, Citas $cita)
    {
        $this->setCita($cita);
        $this->setProspecto($cita->prospecto);
        $this->setNuevoAsesor($request);

        if ($this->existeNuevoAsesor()) {
            $this->reasignarAsesor();
        }

    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function reasignarAsesor()
    {
        $this->prospecto->update([
            'empleado_id' => $this->nuevoAsesor->id
        ]);

        $this->prospecto->asesores()->attach(
            $this->nuevoAsesor->id,
            [
                'temporal' => 0,
                'activo' => 1,
            ]
        );

        $this->prospecto->save();
    }

    /**
     * =======
     * GETTERS
     * =======
     */

    public function getRoute(){

    }

    /**
     * =======
     * SETTERS
     * =======
     */

    public function setNuevoAsesor($request)
    {
        $this->nuevoAsesor = Empleado::find($request->nuevoAsesorId);
    }

    public function setCita($cita)
    {
        $this->cita = $cita;
    }

    public function setProspecto($prospecto)
    {
        $this->prospecto = $prospecto;
    }

    /**
     * ========
     * BOOLEANS
     * ========
     */

    public function existeNuevoAsesor()
    {
        return !is_null($this->nuevoAsesor);
    }
}
