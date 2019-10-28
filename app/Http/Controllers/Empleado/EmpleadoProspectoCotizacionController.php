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
use Carbon\Carbon;

class EmpleadoProspectoCotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Empleado $empleado,Prospecto $prospecto)
    {

        return view('empleado.prospecto.cotizacion.index', ['empleado'=>$empleado, 'prospecto' => $prospecto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Empleado $empleado,Prospecto $prospecto)
    {
        $fecha_actual = Carbon::now();
        $promociones = Promocion::where('valido_inicio', '<=', $fecha_actual->toDateString())->orderBy('valido_inicio','desc')->get();
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


        $request->validate([
            'monto'=>'required|numeric',
            'ahorro'=>"nullable|numeric",
            'plan'=>"nullable|numeric",
            'descuento'=>'nullable|numeric',
            'promocion'=>'nullable|numeric',
            'tipo_inscripcion'=>'string|nullable',

        ]);
        
        if ($request->plan) {
            $plan = Plan::find($request->plan);
            $promocion = Promocion::find($request->promocion);
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
            $cotizacion->update([
                'plan_id' => Plan::where('tipo','libre')->first()->id,
            ]);
        }

        $verificar = $cotizacion->save();


        if($verificar && sizeof($prospecto->cotizaciones)>=7){
            $prospecto->cotizaciones->first()->delete();
        }

        if($cotizacion->tipo_inscripcion && $cotizacion->tipo_inscripcion == "0_inscripcion_inicial"){
            event(new Cotizacion0Created($cotizacion));
        }
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
        $tablaPL = null;
        if($cotizacion->plan->abreviatura == "PL"){
            $tablaPL = $this->getTablaPlanLibre($cotizacion->monto, $cotizacion->plan);
        }
        $inscripcion = 0;
        if($cotizacion->promocion){
            if ($cotizacion->promocion->tipo_monto === "porcentaje") {
                $inscripcion = $cotizacion->inscripcion - ($cotizacion->inscripcion * ($cotizacion->promocion->monto / 100));
            }
            elseif ($cotizacion->promocion->tipo_monto === "efectivo") {
                $inscripcion = $cotizacion->inscripcion - $cotizacion->promocion->monto;
            }
            else{
                $inscripcion = $cotizacion->inscripcion;
            }
        }
        return view('empleado.prospecto.cotizacion.view', ['empleado'=>$empleado,'prospecto' => $prospecto, 'cotizacion' => $cotizacion, 'inscripcion'=>$inscripcion, 'tablaPL'=>$tablaPL]);
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
        // $pdf= '';  Se uso para una prueba de email TODO: borrar despues
        $enviar = $cotizacion->enviarCotizacion($prospecto->email,$pdf);
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

    private function getTablaPlanLibre($monto, $plan)
    {
        if(gettype($plan) == "string")
            $plan = Plan::find($plan);
        $res = $plan->getMontoscontratos($monto);
        $aux;
        foreach ($res as $monto) {
            switch ($monto) {
                case 300000:
                    $aux[] = ['minimo'=>1000,'posible1'=>2000,'posible2'=>3000,'posible3'=>4000,'maximo'=>5000];
                    break;
                case 350000:
                    $aux[] = ['minimo'=>2100,'posible1'=>3100,'posible2'=>4100,'posible3'=>5100,'maximo'=>5600];
                    break;
                case 400000:
                    $aux[] = ['minimo'=>2400,'posible1'=>3400,'posible2'=>4400,'posible3'=>5400,'maximo'=>6400];
                    break;
                case 450000:
                    $aux[] = ['minimo'=>2700,'posible1'=>3700,'posible2'=>4700,'posible3'=>5700,'maximo'=>7200];
                    break;
                case 500000:
                    $aux[] = ['minimo'=>3000,'posible1'=>4000,'posible2'=>5000,'posible3'=>6000,'maximo'=>8000];
                    break;
                case 550000:
                    $aux[] = ['minimo'=>3000,'posible1'=>4000,'posible2'=>5000,'posible3'=>6000,'maximo'=>8000];
                    break;
            }
        }
        $res = ['minimo'=>0,'posible1'=>0,'posible2'=>0,'posible3'=>0,'maximo'=>0];;
        foreach ($aux as $contrato) {
            $res['minimo'] += $contrato['minimo'];
            $res['posible1'] += $contrato['posible1'];
            $res['posible2'] += $contrato['posible2'];
            $res['posible3'] += $contrato['posible3'];
            $res['maximo'] += $contrato['maximo'];
        }
        return $res;
    }
}
