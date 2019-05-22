<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\Banco;
use App\TipoContrato;
use App\TipoBaja;
use App\TipoArea;
use App\TipoPuesto;
use App\Sucursal;
use App\EmpleadoDatoLab;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmpleadoDatoLabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Empleado $empleado)
    {
        //
        $dato_lab= $empleado->datos_laborales->last();
        $historial = $empleado->datos_laborales()->paginate(5);
        return view('empleado.datoslaborales.index',['empleado'=>$empleado,'dato_lab'=>$dato_lab,'historial'=>$historial]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Empleado $empleado)
    {
        $datoslab = new EmpleadoDatoLab;
        $contratos = TipoContrato::get();
        $bajas = TipoBaja::get();
        $areas =   TipoArea::get();
        $puestos = TipoPuesto::get();
        $bancos=Banco::get();
        $edit = false;
        
        return view('empleado.datoslaborales.create',[
            'empleado'=>$empleado,
            'bajas'=>$bajas,
            'contratos'=>$contratos,
            'datoslab'=>$datoslab,
            'areas'=>$areas, 
            'puestos'=>$puestos,
            'edit'=>$edit,
            'bancos'=>$bancos]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datoslab = new EmpleadosDatosLab;
        $datoslab->empleado_id = $request->empleado_id;

        $datoslab->fechacontratacion = $request->fechacontratacion;
        $datoslab->fechaactualizacion = date("Y-m-d");

        $datoslab->area_id = $request->area_id;
        $datoslab->puesto_id = $request->puesto_id;

        $datoslab->salarionom = $request->salarionom;
        $datoslab->salariodia = $request->salariodia ;
        
        $datoslab->periodopaga = $request->periodopaga ;
        $datoslab->prestaciones = $request->prestaciones ;
        $datoslab->regimen = $request->regimen ;
        $datoslab->hentrada = $request->hentrada ;
        $datoslab->hsalida = $request->hsalida ;
        $datoslab->hcomida = $request->hcomida ;
        $datoslab->lugartrabajo = $request->lugartrabajo ;
        $datoslab->banco = $request->banco ;
        $datoslab->cuenta = $request->cuenta ;
        $datoslab->clabe = $request->clabe ;
        $datoslab->fechabaja = $request->fechabaja ;
        $datoslab->tipobaja_id = $request->tipobaja_id ;
        $datoslab->comentariobaja = $request->comentariobaja ;

        $datoslab->contrato_id = $request->contrato_id ;
        $datoslab->almacen_id = $request->almacen_id ;
        if ($request->bonopuntualidad == 'on') {
            # code...
            $datoslab->bonopuntualidad = true;
            // dd($request->all());
        } else {
            # code...
            $datoslab->bonopuntualidad = false;
        }
    //--------- BAJA --------------------------------
        if($request->fechabaja!=null){
            $empleado->delete();
            Alert::success('Baja de Empleado', 'Se redireccionará a la Lista de Empleados');
            return redirect()->route('empleados.index');
        }else{
             $datoslab->save();
        Alert::info('Datos laborales creado', 'Siga agregando información al empleado');
        return redirect()->route('empleados.datoslaborales.index',['empleado'=>$empleado,'datoslab'=>$datoslab]);
        
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpleadoDatoLab  $empleadoDatoLab
     * @return \Illuminate\Http\Response
     */
    public function show(EmpleadoDatoLab $empleadoDatoLab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmpleadoDatoLab  $empleadoDatoLab
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpleadoDatoLab $empleadoDatoLab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmpleadoDatoLab  $empleadoDatoLab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpleadoDatoLab $empleadoDatoLab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmpleadoDatoLab  $empleadoDatoLab
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpleadoDatoLab $empleadoDatoLab)
    {
        //
    }
}
