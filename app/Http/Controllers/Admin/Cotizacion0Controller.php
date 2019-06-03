<?php

namespace App\Http\Controllers\Admin;

use App\Cotizacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Cotizacion0Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cotizaciones = Cotizacion::where('tipo_inscripcion','0_inscripcion_inicial')->get();
        return view('admin.cotizacion0.index',['cotizaciones'=>$cotizaciones]);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function show(Cotizacion $cotizacion0)
    {
        //
        $prospecto = $cotizacion0->prospecto;
        return view('admin.cotizacion0.show',['cotizacion0'=>$cotizacion0,'prospecto'=>$prospecto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cotizacion $cotizacion0)
    {
        //
        $cotizacion0->liberar = 1;
        $cotizacion0->save();
        return redirect()->route('cotizacion0.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cotizacion $cotizacion0)
    {
        //
        if($cotizacion0->perfil){
            $perfil = $cotizacion0->perfil;
            $perfil->historial_crediticio->delete();
            $perfil->inmueble_pretendido->delete();
            foreach ($perfil->referencia_personals as $ref) {
                $ref->delete();
            }
            $perfil->delete();
        }
        $cotizacion0->delete();
        return redirect()->route('cotizacion0.index');
    }
}
