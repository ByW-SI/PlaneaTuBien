<?php

namespace App\Http\Controllers\Empleado;

use App\Cotizacion;
use App\Empleado;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use App\Promocion;
use App\Prospecto;
use App\Plan;
use App\FactorActualizacion;
use App\Events\Cotizacion0Created;
use Illuminate\Http\Request;

class EmpleadoProspectoCotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Empleado $empleado,Prospecto $prospecto)
    {

        // $cotizaciones = $prospecto->cotizaciones;
        // dd();

        return view('empleado.prospecto.cotizacion.index', ['empleado'=>$empleado, 'prospecto' => $prospecto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Empleado $empleado,Prospecto $prospecto)
    {
        $promociones = Promocion::orderBy('valido_inicio','desc')->get();
        $planes = Plan::orderBy('mes_adjudicado','asc')->get();
        // return view('empleado.prospecto.cotizacion.create', ['empleado'=>$empleado,'prospecto' => $prospecto,'promociones'=>$promociones]);
        return view('empleado.prospecto.cotizacion.form', ['empleado'=>$empleado,'prospecto' => $prospecto,'promociones'=>$promociones,'planes'=>$planes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Empleado $empleado,Prospecto $prospecto, Request $request)
    {

        // $folio = $empleado->id.$prospecto->id.date('dmY');
        // dd($folio);

        // dd( Plan::where('tipo','libre')->first()->id );


        $request->validate([
            'monto'=>'required|numeric',
            'ahorro'=>"nullable|numeric",
            'plan'=>"nullable|numeric",
            'descuento'=>'nullable|numeric',
            'promocion'=>'nullable|numeric',
            'tipo_inscripcion'=>'string|nullable',

        ]);
        //dd($request->all());
        if ($request->plan) {
            $plan = Plan::find($request->plan);
            $promocion = Promocion::find($request->promocion);
        
            // $folio = $prospecto->id.$plan->abreviatura.(sizeOf($prospecto->cotizaciones)+1);
            // dd($cotizacion->inscripcion);
            $cotizacion = new Cotizacion($request->all());
            $cotizacion->inscripcion= floatval(str_replace(',', '', str_replace('', '.', $cotizacion->inscripcion)));
            $year = date('y');
            for ($i = 0; $i < 9999; $i++) {
                $folio = str_pad("$i".$year,6,'0',STR_PAD_LEFT);
                $cot_exist = Cotizacion::where('folio',$folio)->get();
                if($cot_exist->isEmpty()){
                    $cotizacion->folio = $folio;
                    break;
                }
            }
            $cotizacion->elegir = 0;
            $cotizacion->plan_id = $plan->id;
            $prospecto->cotizaciones()->save($cotizacion);
            $cotizacion->promocion()->associate($promocion);
            $factor = FactorActualizacion::where('autorizar',1)->get()->last();
            $cotizacion->factor_actualizacion = ($factor) ? $factor->porcentaje : 3 ;
        }
        else {

            // dd('aqui');

            $cotizacion = new Cotizacion($request->all());
            $year = date('y');
            for ($i = 0; $i < 9999; $i++) {
                $folio = str_pad("$i".$year,6,'0',STR_PAD_LEFT);
                $cot_exist = Cotizacion::where('folio',$folio)->get();
                if($cot_exist->isEmpty()){
                    $cotizacion->folio = $folio;
                    break;
                }
            }
            $cotizacion->elegir = 0;
            $cotizacion->plan_id = null;
            $prospecto->cotizaciones()->save($cotizacion);
            $cotizacion->promocion()->associate(null);
            $factor = FactorActualizacion::where('autorizar',1)->get()->last();
            $cotizacion->factor_actualizacion = ($factor) ? $factor->porcentaje : 3 ;
        }

        

        $verificar = $cotizacion->save();

        $cotizacion->update([
            'plan_id' => Plan::where('tipo','libre')->first()->id,
        ]);

        if($verificar && sizeof($prospecto->cotizaciones)>=7){
            $prospecto->cotizaciones->first()->delete();
            // dd('se borro');
        }

        if($cotizacion->tipo_inscripcion && $cotizacion->tipo_inscripcion == "0_inscripcion_inicial"){
            event(new Cotizacion0Created($cotizacion));
            // dd('si entro');
        }
        
        // dd('fin');
        return redirect()->route('empleados.prospectos.cotizacions.index', ['empleado'=>$empleado,'prospecto' => $prospecto]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado,Prospecto $prospecto, Cotizacion $cotizacion)
    {
        return view('empleado.prospecto.cotizacion.view', ['empleado'=>$empleado,'prospecto' => $prospecto, 'cotizacion' => $cotizacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Empleado $empleado,Request $request, Cotizacion $cotizacion)
    {
        //
    }

    public function pdf(Empleado $empleado, Prospecto $prospecto, Cotizacion $cotizacion) {
        $date = date('d-m-Y');
        $pdf = PDF::loadView('empleado.prospecto.cotizacion.pdf', ['empleado'=>$empleado,'prospecto' => $prospecto, 'cotizacion' => $cotizacion]);
        return $pdf->stream();
        return $pdf->download('cotizacion' . $date . '.pdf');
    }

    public function sendMail(Empleado $empleado,Prospecto $prospecto,Cotizacion $cotizacion){
        $pdf = PDF::loadView('prospectos.cotizacions.pdf', ['prospecto' => $prospecto, 'cotizacion' => $cotizacion]);
        $enviar = $cotizacion->enviarCotizacion($prospecto->email,$pdf);
        // dd($enviar);
        // return(new \App\Mail\CotizacionEnviada($cotizacion))->render();
        // dd($cotizacion->task_send_mail);
        if ($cotizacion->task_send_mail) {
            $task=$cotizacion->task_send_mail;
            $task->hecho=1;
            $task->save();
        }
        if($enviar){
            return redirect()->route('empleados.prospectos.cotizacions.index', ['empleado'=>$empleado,'prospecto' => $prospecto]);
        }
        else{
            return redirect()->route('empleados.prospectos.cotizacions.index', ['empleado'=>$empleado,'prospecto' => $prospecto]);
        }
    }
}
