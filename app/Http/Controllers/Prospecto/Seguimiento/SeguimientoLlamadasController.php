<?php

namespace App\Http\Controllers\Prospecto\Seguimiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Prospecto;
use App\ResultadoLlamada;
use App\SeguimientoLlamadas;
use App\Services\SeguimientoLlamada\IndexSeguimientoLlamadaService;

class SeguimientoLlamadasController extends Controller
{
    /**
     * Muestra una lista con los prospectos con estatus seguimeinto de llamadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indexSeguimientoLLamadaService = new IndexSeguimientoLlamadaService();
        $prospectos = $indexSeguimientoLLamadaService->getProspectos();
        $estatusLlamada = $indexSeguimientoLLamadaService->getEstastusLlamada();
        $seguimientoLlamadas = $indexSeguimientoLLamadaService->getSeguimientoLLamadas();

        // return $prospectos->pluck('asesor')->pluck('sucursal');

        // return Prospecto::where('estatus_id',1)->has('asesores')->get();

        return view('prospectos.seguimientoLlamadas.index', compact('prospectos', 'estatusLlamada', 'seguimientoLlamadas'));
    }

    /**
     * Guarda los registros del seguimiento de cada prospecto.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prospecto = Prospecto::find($request->prospecto_id);
        $asesor = $prospecto->asesor;

        SeguimientoLlamadas::create([
            'asesor_id' => $asesor->id,
            'prospecto_id' => $prospecto->id,
            'resultado_llamada_id' => $request->resultado_llamada_id,
            'fecha_siguiente_contacto' => $request->fecha_siguiente_contacto,
            'fecha_contacto' => $request->fecha_contacto,
            'comentario' => $request->comentario,
        ]);

        return redirect()->route('seguimiento.llamadas.index');
    }

    public function noCalificado(Request $request)
    {
    	//dd($request->all());

    	$prospecto = Prospecto::find($request->prospecto);

    	$seguimiento = SeguimientoLlamadas::create([
            'fecha_contacto' => $request->fecha_actual,
            'fecha_siguiente_contacto' => $request->fechaSeguimiento,
            'asesor_id' => $prospecto->asesores()->where('activo', '1')->get()->last()->id,
            'comentario' => $request->comentario,
            'resultado_llamada_id' => $request->estatusId,
            'prospecto_id' => $prospecto->id
        ]);
        $prospecto->estatus_id = $request->estatusId;
        $prospecto->save();

        $prospectos = $this->getProspectosXEstatus("1");
        $seguimiento = $this->getSeguimientoLlamadaProspectos($prospectos);

        return response()->json(['prospecto' => $prospecto, "seguimiento" => $seguimiento, "prospectos" => $prospectos], 200);
    }

    public function getProspectosXEstatus($estatus_id)
    {
        $empleado = Auth::user()->empleado;

        // dd($empleado->prospectos()->get());

    	if ($empleado->tipo == 'Admin') {
    		$prospectos = Prospecto::where('estatus_id', '1')->get();
    	}
    	else {
    		$prospectos = $empleado->prospectos()->where('estatus_id', $estatus_id)->get();
        }

    	return $prospectos;
    }

    public function getSeguimientoLlamadaProspectos($prospectos)
    {
    	$seguimientoLlamadas = [];

        // Obtenemos los registros de las llamadas de cada prospecto, solo los ultimos 4
        foreach ($prospectos as $key => $value) {
            $aux = [];
            $segLlamada = $value->seguimientoLlamadas;

            for ($i=0; $i < 4; $i++) { 
                if(isset($segLlamada[$i])){
                	//dd($segLlamada[$i]->resultado_llamada_id);
                    $aux[] = [
                        $segLlamada[$i]->fecha_contacto,
                        ResultadoLlamada::find($segLlamada[$i]->resultado_llamada_id)->codigo,
                        $segLlamada[$i]->fecha_siguiente_contacto
                    ];
                } else {
                    $aux[] = [
                        '',
                        '',
                        ''
                    ];
                }
            }
           $seguimientoLlamadas[] = $aux;
        }

        return $seguimientoLlamadas;
    }
}
