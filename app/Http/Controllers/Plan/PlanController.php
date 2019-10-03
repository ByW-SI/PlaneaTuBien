<?php

namespace App\Http\Controllers\Plan;

use App\Plan;
use App\Grupo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $planes = Plan::orderBy('nombre','asc')->get();
        return view('plan.index',['planes'=>$planes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $grupos = Grupo::where([
            ['activo',1],
            ['fecha_fin','>=',date('Y-m-d')]
        ])->get();
        return view('plan.form',['grupos'=>$grupos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input('tipo_plan'));

        if( $request->input('tipo_plan') == 'plan normal' ){
            $rules=[
                'nombre'=>'required',
                'plazo'=>'required|integer',
                'mes_aportacion_adjudicado'=>'required|integer',
                'mes_adjudicado'=>'required|integer',
                'plan_meses'=>'required|integer',
                'actualizaciones'=>'required|integer',
                'aportacion_1'=>'required|numeric',
                'mes_1'=>'required|integer',
                'aportacion_2'=>'required|numeric',
                'mes_2'=>'required|integer',
                'aportacion_3'=>'required|numeric',
                'mes_3'=>'required|integer',
                'aportacion_liquidacion'=>'required|numeric',
                'mes_liquidacion'=>'required|integer',
                'semestral'=>'required|numeric',
                'anual'=>'required|numeric',
                'inscripcion'=>'required|numeric',
                'cuota_admon'=>'required|numeric',
                's_v'=>'required|numeric',
                's_d'=>'required|numeric',
            ];
            $this->validate($request,$rules);
            $plan = Plan::create($request->all());
            foreach ($request->grupos as $grupo_id) {
                $plan->grupos()->attach($grupo_id);
            }
        }

        if( $request->input('tipo_plan') == 'plan libre' ){
            $rules=[
                'nombre'=>'required',
                'plazo'=>'required|integer',
                'plan_meses'=>'required|integer',

            ];
            $this->validate($request,$rules);
            $plan = Plan::create($request->all());
            foreach ($request->grupos as $grupo_id) {
                $plan->grupos()->attach($grupo_id);
            }
        }
        
        return redirect()->route('plans.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
        return view('plan.show',['plan'=>$plan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }

    public function getPlanes($p_ahorrado)
    {
        $planes = Plan::where('aportacion_1',$p_ahorrado)->orderBy('mes_adjudicado','asc')->get();
        return response()->json(['planes'=>$planes],201);
    }
}
