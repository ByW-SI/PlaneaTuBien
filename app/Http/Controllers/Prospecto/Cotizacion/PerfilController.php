<?php

namespace App\Http\Controllers\Prospecto\Cotizacion;

use App\Banco;
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
        $bancos = Banco::orderBy('nombre','asc')->get();
        // dd($perfil);
        return view('prospectos.perfil.form',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion, 'folio'=>$folio,'bancos'=>$bancos]);
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
        $h_crediticio= new PerfilHistorialCrediticioCliente([
            'tarjeta_debito'=>$request->tarjeta_debito,
            'tarjeta_credito'=>$request->tarjeta_credito,
            'numero_tarjeta_debito'=>$request->numero_tarjeta_debito,
            'numero_tarjeta_credito'=>$request->numero_tarjeta_credito,
            'tarjetas_credito'=> json_encode($request->tarjetas_credito),
            'tarjetas_debito'=>json_encode($request->tarjetas_debito),
            'en_buro_credito'=>$request->en_buro_credito,
            'buro_credito'=>($request->en_buro_credito ? $request->buro_credito : ""),
            'limite_credito'=>$request->limite_credito,
            'destino_1'=>$request->destino_1,
            'tipo_destino_1'=>$request->tipo_destino_1,
            'monto_destino_1'=>$request->monto_destino_1,
            'destino_2'=>$request->destino_2,
            'tipo_destino_2'=>$request->tipo_destino_2,
            'monto_destino_2'=>$request->monto_destino_2,
            'destino_3'=>$request->destino_3,
            'tipo_destino_3'=>$request->tipo_destino_3,
            'monto_destino_3'=>$request->monto_destino_3,
            'calificacion_credito'=>$request->calificacion_credito,
            'descripcion_calificacion'=>$request->descripcion_calificacion

        ]);
        $perfil->historial_crediticio()->save($h_crediticio);
        $inmueble = new PerfilInmueblePretendidoCliente($request->all());
        if ($inmueble->tipo_inmueble == "Otro") {
            $inmueble->tipo_inmueble = $request->otro_name;
            // $inmueble->save();
        }
        $perfil->inmueble_pretendido()->save($inmueble);
        for ($i = 0; $i < sizeof($request->nombre) ; $i++) {
            $referencia = new PerfilReferenciaPersonalCliente([
                'nombre' => $request->nombre[$i+1],
                'paterno' => $request->paterno[$i+1],
                'materno' => $request->materno[$i+1],
                'parentesco' => $request->parentesco[$i+1],
                'telefono' =>$request->telefono[$i+1],
                'celular'=>$request->celular[$i+1]
            ]);
            $perfil->referencia_personals()->save($referencia);
        }
        $cotizacion->elegir = 1;
        $cotizacion->save();
        $cotizaciones = $prospecto->cotizaciones()->where('elegir',0)->get();
        foreach ($cotizaciones as $cot) {
            $cot->delete();
        }
        return redirect()->route('prospectos.perfil.datos_personal.index',['prospecto'=>$prospecto]);


    }

}
