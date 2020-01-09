<?php

namespace App\Services\Prospecto;

use App\Prospecto;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class StoreProspectoService
{

    public function __construct(Request $request)
    {
        $rules = [
            'nombre' => 'required|max:191',
            'appaterno' => 'required|max:191',
            'apmaterno' => 'nullable|max:191',
            'email' => "required|e-mail",
            'telefono' => "nullable|numeric",
            'celular' => "required|numeric"
        ];
        $this->validate($request, $rules);
        $prospecto = new Prospecto($request->all());
        $prospecto->empleado_id = (Auth::user()->empleado->id == 1 ? null : Auth::user()->empleado->id);
        $prospecto->save();
    }
}
