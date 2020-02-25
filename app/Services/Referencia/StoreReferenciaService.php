<?php

namespace App\Services\Referencia;

use App\Contrato;
use App\Presolicitud;
use App\Prospecto;
use App\Referencia;
use Illuminate\Http\Request;

class StoreReferenciaService
{

    protected $prospecto;
    protected $presolicitud;
    protected $request;

    public function __construct(Prospecto $prospecto, Presolicitud $presolicitud, Request $request)
    {
        $this->prospecto = $prospecto;
        $this->presolicitud = $presolicitud;
        $this->request = $request;
        // dd('voy aqui');
        $this->crearReferencias($request);
        $this->crearContrato();
    }

    /**
     * =======
     * METHODS
     * =======
     */

    public function crearContrato(){
        Contrato::create([
            'numero_contrato' => count( Contrato::get() ) + 1,
            'monto' => $this->presolicitud->perfil->cotizacion,
            'estado' => 'registrado',
            'grupo_id' => 1,
            'presolicitud_id' => $this->presolicitud->id,
        ]);
    }

    public function crearReferencias(Request $request)
    {
        for ($i = 0; $i <= 2; $i++) {
            $referencia = new Referencia([
                'paterno' => $request->paterno[$i],
                'materno' => $request->materno[$i],
                'nombre' => $request->nombre[$i],
                'telefono' => $request->telefono[$i],
                'parentesco' => $request->parentesco[$i]
            ]);
            $this->presolicitud->referencias()->save($referencia);
        }
    }
}
