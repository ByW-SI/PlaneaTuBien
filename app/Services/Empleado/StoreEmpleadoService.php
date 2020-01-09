<?php

namespace App\Services\Empleado;

use App\Empleado;
use App\Sucursal;
use Illuminate\Support\Facades\Validator;

class StoreEmpleadoService
{

    public function __construct($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|unique:empleados',
            'rfc' => 'required|unique:empleados',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('status', 'ERROR: El correo o el RFC ya existe en el sistema');
        }

        /** Pendiennte por ver si todavia se ocupa este codigo ultima fecha: 17/12/2019**/
        $empleado = Empleado::create($request->all());
        if (!empty($request->input('gerente'))) {
            $empleado->id_jefe = $request->input('gerente');
            $empleado->save();
        }
        if (!empty($request->input('supervisor'))) {
            $empleado->id_jefe = $request->input('supervisor');
            $empleado->save();
        }

        $empleado->update([
            'puesto' => $request->puesto,
            'cargo' => $request->puesto,
            'tipo' => $request->puesto,
        ]);

        /** Fin Pendiennte **/
        $sucursal = Sucursal::find($request->sucursal);
        $empleado->sucursal()->associate($sucursal);

        if ($request->cp && $request->colonia && $request->estado && $request->delegacion && $request->calle)
            $empleado->direccion()->create($request->all());

        $empleado->save();
    }
}
