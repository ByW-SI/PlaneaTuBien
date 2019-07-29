<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud;

use App\Contrato;
use App\Http\Controllers\Controller;
use App\Presolicitud;
use App\Prospecto;
use Illuminate\Http\Request;

class PresolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Prospecto $prospecto)
    {
        //
        if ($prospecto->perfil) {
            if ($prospecto->perfil->presolicitud) {
                $presolicitud = $prospecto->perfil->presolicitud;
                // dd($presolicitud->status);
                return view('prospectos.presolicitud.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
            }
            else{
                return redirect()->route('prospectos.presolicitud.create',['prospecto'=>$prospecto]);
            }
        }
        else{
            return back();
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Prospecto $prospecto)
    {
        //
        // dd($prospecto);
        return view('prospectos.presolicitud.form',['prospecto'=>$prospecto]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Prospecto $prospecto, Request $request)
    {
        //
        $rules= [
            'paterno'=>'required|max:190',
            'materno'=>'nullable|max:190',
            'nombre'=>'required|max:190',
            'calle'=>'required|max:190',
            'numero_ext'=>"required|max:190",
            'numero_int'=>"required|max:190",
            'colonia'=>'required|max:190',
            'municipio'=>"required|max:190",
            'estado'=>"required|max:190",
            'cp'=>"numeric|required|digits_between:5,7",
            'rfc'=>"alpha_num|required|max:14",
            'tel_casa'=>"required|max:15",
            'tel_oficina'=>"nullable|max:15",
            'tel_celular'=>"required|max:15",
            'email'=>"email|required|max:190",
            'fecha_nacimiento'=>"date|required|after:".date('Y-m-d', strtotime('-64 years')),
            'lugar_nacimiento'=>"required|max:190",
            'nacionalidad'=>"required|max:190",
            'sexo'=>"required|in:Masculino,Femenino",

            'estado_civil'=>"required|in:Soltero,Casado,Viudo,Divorciado,Unión Libre",
            'profesion'=>"required|max:190",
            'empresa'=>"nullable|max:190",
            'puesto'=>"nullable|max:190",
            'antiguedad_actual'=>"required|max:190",
            'antiguedad_anterior'=>"required|max:190",
            'ingreso_mensual'=>"numeric|required",
            'enterarse'=>"required|max:190",
        ];
        $this->validate($request,$rules);
        $perfil = $prospecto->perfil;
        $presolicitud = new Presolicitud($request->all());
        $presolicitud->folio = 100+Presolicitud::all()->count();
        $presolicitud->precio_inicial= $perfil->cotizacion->monto;
        $presolicitud->plazo_contratado= $perfil->cotizacion->plan->plazo;
        $presolicitud->precio_nolose=$perfil->cotizacion->plan->plan_meses;
        $perfil->presolicitud()->save($presolicitud);
        $cotizacion =$presolicitud->cotizacion();
        $grupos = $cotizacion->plan->grupos;
        if ($presolicitud) {
            if ($cotizacion->liberar) {
                foreach ($grupos as $grupo) {
                    if($grupo->contratos > 0 && $grupo->activo == 1){
                        if ($presolicitud->contratos->isEmpty()) {
                          foreach ($cotizacion->contratos() as $value) {
                            $contrato = new Contrato;
                            $contrato->monto = $value;
                            $contrato->grupo()->associate($grupo->id);
                            $grupo->contratos -= 1;
                            $grupo->save();
                            $contrato->numero_contrato = 500-$grupo->contratos;
                            $contrato->estado = "registrado";
                            $presolicitud->contratos()->save($contrato);
                          }
                        }
                    }
                }
            }
            return redirect()->route('prospectos.presolicitud.conyuge.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        }
        // var_dump("<br>");
        // dd($request->all());
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Presolicitud  $presolicitud
     * @return \Illuminate\Http\Response
     */
    public function show(Presolicitud $presolicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Presolicitud  $presolicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Presolicitud $presolicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Presolicitud  $presolicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presolicitud $presolicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Presolicitud  $presolicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presolicitud $presolicitud)
    {
        //
    }
}
