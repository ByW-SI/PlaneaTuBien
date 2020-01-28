<?php

namespace App\Services\Empleado;

use App\Sucursal;

class UpdateEmpleadoService
{

    protected $empleado;

    public function __construct($request, $empleado)
    {
        // dd($request->input());

        $this->setEmpleado($empleado);
        $this->actualizarDatosEmpleado($request);

    }

    protected function setEmpleado($empleado)
    {
        $this->empleado = $empleado;
    }

    protected function actualizarDatosEmpleado($request)
    {
        $this->empleado->update($request->all());
        $this->empleado->sucursal_id = $request->sucursal;
        $this->empleado->id_jefe = $request->jefe_id;
        $this->empleado->cargo = $request->puesto;
        $this->empleado->puesto = $request->puesto;
        $this->empleado->tipo = $request->puesto;

        if ($request->cp && $request->colonia && $request->estado && $request->delegacion && $request->calle)
            $this->empleado->direccion->update($request->all());


        is_null($this->empleado->user) ?: $this->empleado->user->update(['email' => $this->empleado->email]);
        $this->empleado->save();
    }
}
