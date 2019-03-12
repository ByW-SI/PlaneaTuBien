<?php

namespace App\Http\Controllers\Prospecto\Cotizacion;

use App\Cotizacion;
use App\Http\Controllers\Controller;
use App\PerfilDatosPersonalCliente;
use App\PerfilHistorialCrediticioCliente;
use App\PerfilInmueblePretendidoCliente;
use App\PerfilReferenciaPersonalCliente;
use App\Prospecto;
use Illuminate\Http\Request;

class PerfilController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Prospecto $prospecto, Cotizacion $cotizacion)
    {
        //
        $perfils      = PerfilDatosPersonalCliente::all();
        $perfil  = $perfils->last();
        if ($perfil == null) {
            $folio=1;
        }
        else{
            $folio=$perfil->id+1;
        }
        // dd($perfil);
        return view('prospectos.perfil.form',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion, 'folio'=>$folio]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Prospecto $prospecto, Cotizacion $cotizacion,Request $request)
    {
        // dd($request->all());
        $perfil = new PerfilDatosPersonalCliente($request->all());
        $perfil->folio = $request->folio;
        $perfil->fecha = date('Y-m-d');
        $perfil->clave= $request->clave;
        $perfil->plan = $request->plan;
        $perfil->prospecto_id = $prospecto->id;
        $perfil->cotizacion_id = $cotizacion->id;
        $perfil->empleado_id = $request->asesor_id;
        $perfil->save();
        $h_crediticio= new PerfilHistorialCrediticioCliente($request->all());
        $perfil->historial_crediticio()->save($h_crediticio);
        $inmueble = new PerfilInmueblePretendidoCliente($request->all());
        $perfil->inmueble_pretendido()->save($inmueble);
        for ($i = 0; $i < sizeof($request->nombre_completo) ; $i++) {
            $referencia = new PerfilReferenciaPersonalCliente([
                'nombre_completo' => $request->nombre_completo[$i+1],
                'parentesco' => $request->parentesco[$i+1],
                'telefono' =>$request->telefono[$i+1],
                'celular'=>$request->celular[$i+1]
            ]);
            $perfil->referencia_personals()->save($referencia);
        }
        return redirect()->route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]);


    }

}
