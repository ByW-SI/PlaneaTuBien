<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud;

use App\Contrato;
use App\Cotizacion;
use App\Http\Controllers\Controller;
use App\MedioContacto;
use App\PagoInscripcion;
use App\Pagos;
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
            //dd($prospecto->perfil->presolicitud);
            if ($prospecto->perfil->presolicitud) {
                $presolicitud = $prospecto->perfil->presolicitud;
                //dd($presolicitud->status);
                return view('prospectos.presolicitud.index', ['prospecto' => $prospecto, 'presolicitud' => $presolicitud]);
            } else {
                return redirect()->route('prospectos.presolicitud.create', ['prospecto' => $prospecto]);
            }
        } else {
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
        // dd(!$prospecto->tienePerfil());
        if (!$prospecto->tienePerfil()) {
            return redirect()->back();
        }

        $mediosDeContacto = MedioContacto::get();

        return view('prospectos.presolicitud.form', ['prospecto' => $prospecto, 'mediosDeContacto' => $mediosDeContacto]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Prospecto $prospecto, Request $request)
    {
        // dd($request->input());

        $cotizacion = Cotizacion::find($request->cotizacion_id);

        if (!$cotizacion->pago_inscripcions->count()) {
            return redirect()->back();
        }

        $rules = [
            'appaterno' => 'required|max:190',
            'apmaterno' => 'nullable|max:190',
            'nombre' => 'required|max:190',
            'calle' => 'required|max:190',
            'numero_ext' => "required|max:190",
            'numero_int' => "nullable|max:190",
            'colonia' => 'required|max:190',
            'municipio' => "required|max:190",
            'estado' => "required|max:190",
            'cp' => "numeric|required|digits_between:5,7",
            'rfc' => "alpha_num|required|max:14",
            'tel_casa' => "required|max:15",
            'tel_oficina' => "nullable|max:15",
            'tel_celular' => "required|max:15",
            'email' => "email|required|max:190",
            'fecha_nacimiento' => "date|required|after:" . date('Y-m-d', strtotime('-64 years')),
            'lugar_nacimiento' => "required|max:190",
            'nacionalidad_1' => "required|max:190",
            'sexo' => "required|in:Masculino,Femenino",
            // 'edad'=>'required|numeric|lte:64',
            'estado_civil' => "required|in:Soltero,Casado,Viudo,Divorciado,Unión Libre",
            'ocupacion_1' => "required|max:190",
            'empresa' => "nullable|max:190",
            'puesto' => "nullable|max:190",
            'antiguedad_1' => "required|max:190",
            'antiguedad_2' => "required|max:190",
            'ingreso_mensual' => "numeric|required",
            'enterarse' => "required|max:190",
        ];
        $this->validate($request, $rules);
        $perfil = $prospecto->perfil;
        $perfil->update([
            'cotizacion_id' => $request->cotizacion_id,
            'municipio' => $request->municipio
        ]);
        $perfil->save();
        // return $perfil;
        $presolicitud = new Presolicitud($request->all());
        $presolicitud->folio = 100 + Presolicitud::all()->count();
        // return $prospecto->cotizaciones()->first();
        $presolicitud->precio_inicial = $perfil->cotizacion->monto;

        if ($perfil->cotizacion->plan->tipo == 'libre') {
            $presolicitud->plazo_contratado = 0;
            $presolicitud->plan = 'libre';
            $perfil->cotizacion->liberar = 1;
            $perfil->cotizacion->update([
                'liberar' => 1
            ]);
        } else {
            $presolicitud->plazo_contratado = $perfil->cotizacion->plan->plazo;
            $presolicitud->plan = $perfil->cotizacion->plan->plan_meses;
        }



        $perfil->presolicitud()->save($presolicitud);
        $cotizacion = $presolicitud->cotizacion();
        $grupos = $cotizacion->plan->grupos;

        if ($presolicitud) {

            if ($cotizacion->liberar) {

                foreach ($grupos as $grupo) {

                    if ($grupo->contratos > 0 && $grupo->activo == 1) {

                        if ($presolicitud->contratos->isEmpty()) {
                            foreach ($cotizacion->contratos() as $value) {
                                $contrato = new Contrato;
                                $contrato->monto = $value;
                                $contrato->grupo()->associate($grupo->id);
                                $grupo->contratos -= 1;
                                $grupo->save();
                                $contrato->numero_contrato = 500 - $grupo->contratos;
                                $contrato->estado = "registrado";
                                $presolicitud->contratos()->save($contrato);
                            }
                        }
                    }
                }
            }

            // $pagoInscripcion = PagoInscripcion::create([
            //     'prospecto_id' => ,
            //     'cotizacion_id' => ,
            //     'status' => ,
            //     'monto' => ,
            //     'identificacion' => ,
            //     'comprobante' => ,
            //     'prospecto_id' => ,
            //     'prospecto_id' => ,
            // ]);

            // dd('stop');

            return redirect()->route('prospectos.presolicitud.conyuge.index', ['prospecto' => $prospecto, 'presolicitud' => $presolicitud]);
        }

        // dd('stop 2');
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

    public function modificarCotizacion(Request $request, Presolicitud $presolicitud)
    {



        $diferenciaInscripcion = floatVal($presolicitud->perfil->cotizacion->totalPagadoDeInscripcion)
            - Cotizacion::find($request->input('cotizacion_id'))->inscripcion;

        // dd($diferenciaInscripcion);

        // return $presolicitud->contratos;

        if ($diferenciaInscripcion > 0) {
            $pago = Pagos::create([
                'monto' => $diferenciaInscripcion,
                'fecha_pago' => date('Y-m-d'),
                'folio' => Pagos::get()->count(),
                'status_id' => 1,
                'tipopago_id' => 1,
                'referencia' => 'referencia',
                'spei' => 'spei',
                'file_comprobante' => 'file',
                'mensualidad_id' => null
            ]);
            $presolicitud->perfil->cotizacion->pago_inscripcions()->first()->update([
                'monto' => $presolicitud->perfil->cotizacion->pago_inscripcions()->first()->monto - $diferenciaInscripcion
            ]);
        }

        $presolicitud->perfil->cotizacion->pago_inscripcions()->update([
            'cotizacion_id' => $request->input('cotizacion_id')
        ]);

        $presolicitud->perfil->update([
            'cotizacion_id' => $request->input('cotizacion_id')
        ]);
        return redirect()->back();
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
