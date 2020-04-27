<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud;

use App\Beneficiario;
use App\Presolicitud;
use App\Prospecto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PresolicitudBeneficiarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Prospecto $prospecto,Presolicitud $presolicitud)
    {
        //
        // dd($presolicitud->beneficiarios);
        if ($presolicitud->beneficiarios->isNotEmpty()) {
            return view('prospectos.presolicitud.beneficiario.index',['presolicitud'=>$presolicitud,'prospecto'=>$prospecto]);
        }
        else{
            return redirect()->route('prospectos.presolicitud.beneficiarios.create',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Prospecto $prospecto,Presolicitud $presolicitud)
    {
        //
        return view('prospectos.presolicitud.beneficiario.form',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Prospecto $prospecto,Presolicitud $presolicitud,Request $request)
    {
        //
        $rules =[
            'paterno.*'=>'required|max:190',
            'materno.*'=>'nullable|max:190',
            'nombre.*'=>'required|max:190',
            'edad.*'=>'required|numeric',
            'parentesco.*'=>'required|max:190',
            'porcentaje.*'=>'required|numeric|max:100'
        ];
        $porcentaje_total = 0.00;
        foreach ($request->porcentaje as $porcentaje) {
            $porcentaje_total+=$porcentaje;
        }
        // $porcentaje_total = 0.00;
        if($porcentaje_total != 100){
            return back()->withErrors('El porcentaje total debe ser igual al 100%')->withInput();
        }
        else{
            $this->validate($request,$rules);
            foreach ($request->paterno as $key=>$paterno) {
                $beneficiario = new Beneficiario([
                    'paterno'=>$request->paterno[$key],
                    'materno'=>$request->materno[$key],
                    'nombre'=>$request->nombre[$key],
                    'edad'=>$request->edad[$key],
                    'parentesco'=>$request->parentesco[$key],
                    'porcentaje'=>$request->porcentaje[$key]
                ]);
                $presolicitud->beneficiarios()->save($beneficiario);
            }
            return redirect()->route('prospectos.presolicitud.referencias.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function show(Beneficiario $beneficiario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function edit(Prospecto $prospecto,Presolicitud $presolicitud,Request $request)
    {
        //
        

        return redirect()->route('prospectos.presolicitud.referencias.index',
        [
            'prospecto'=>$prospecto,
            'presolicitud'=>$presolicitud,
            'beneficiarios'=>$presolicitud->beneficiarios()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Beneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function update(Prospecto $prospecto,Presolicitud $presolicitud,Request $request)
    {
        //
        //

        $rules =[
            'paterno.*'=>'required|max:190',
            'materno.*'=>'nullable|max:190',
            'nombre.*'=>'required|max:190',
            'edad.*'=>'required|numeric',
            'parentesco.*'=>'required|max:190',
            'porcentaje.*'=>'required|numeric|max:100'
        ];
        $porcentaje_total = 0.00;
        foreach ($request->porcentaje as $porcentaje) {
            $porcentaje_total+=$porcentaje;
        }
        // $porcentaje_total = 0.00;
        if($porcentaje_total != 100){
            return back()->withErrors('El porcentaje total debe ser igual al 100%')->withInput();
        }
        else{
            $this->validate($request,$rules);
            foreach ($presolicitud->beneficiarios() as $key=>$beneficiario) {
                $beneficiario->update([
                    'paterno'=>$request->paterno[$key],
                    'materno'=>$request->materno[$key],
                    'nombre'=>$request->nombre[$key],
                    'edad'=>$request->edad[$key],
                    'parentesco'=>$request->parentesco[$key],
                    'porcentaje'=>$request->porcentaje[$key]
                ]);
            }
            return redirect()->route('prospectos.presolicitud.referencias.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beneficiario $beneficiario)
    {
        //
    }
}
