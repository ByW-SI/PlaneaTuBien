<?php

namespace App\Http\Controllers\Prospecto;

use App\Empleado;
use App\Events\ProspectoCreated;
use App\Http\Controllers\Controller;
use App\PerfilDatosPersonalCliente;
use App\Prospecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProspectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd( Auth::user()->empleado );
        $empleado = Auth::user()->empleado;

        if ($empleado->id == 1) {
            $prospectos = Prospecto::get();
        } elseif ($empleado->tipo == "Asesor") {
            $prospectos = $empleado->prospectos;
            // dd($prospectos);
        } elseif ($empleado->tipo == "Supervisor") {
            $prospectos = [];
            foreach ($empleado->empleados as $asesores) {
                foreach ($asesores->prospectos as $prospe) {
                    $prospectos[] = $prospe;
                }
            }
        } elseif ($empleado->tipo == "Gerente") {
            $prospectos = [];
            foreach ($empleado->empleados as $supervisores) {
                foreach ($supervisores->empleados as $asesores) {
                    foreach ($asesores->prospectos as $prospe) {
                        $prospectos[] = $prospe;
                    }
                }
            }
        }else{
            $prospectos = $empleado->prospectos;
        }

        // dd($prospectos);

        return view('prospectos.index', ['prospectos' => $prospectos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asesor = Auth::user()->empleado;
        return view('prospectos.create', ['asesor' => $asesor]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formprospecto(Request $request)
    {
        // dd($request->alert->status);
        return view('prospectos.formprospecto', ['alert' => $request->alert]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitprospecto(Request $request)
    {
        $rules = [
            'nombre' => 'required|max:191',
            'appaterno' => 'required|max:191',
            'apmaterno' => 'nullable|max:191',
            'sexo' => 'nullable|in:["","Hombre","Mujer"]',
            'email' => "required|e-mail",
            'telefono' => "nullable|numeric",
            'celular' => "required|numeric",
        ];
        // dd($this->validate($request,$rules));
        $prospecto = Prospecto::create($request->all());
        event(new ProspectoCreated($prospecto));
        return redirect()->route('prospecto.create', [
            'alert' => [
                'status' => "success",
                'message' => "Muy pronto un asesor se comunicará contigo"
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|max:191',
            'appaterno' => 'required|max:191',
            'apmaterno' => 'nullable|max:191',
            'sexo' => 'nullable|in:,Hombre,Mujer',
            'email' => "required|e-mail",
            'telefono' => "nullable|numeric",
            'celular' => "required|numeric"
        ];
        $this->validate($request, $rules);
        $prospecto = new Prospecto($request->all());
        $prospecto->empleado_id = (Auth::user()->empleado->id == 1 ? null : Auth::user()->empleado->id);
        $prospecto->save();

        return redirect()->route('prospectos.show', ['prospecto' => $prospecto]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function show(Prospecto $prospecto)
    {
        $empleado = Auth::user()->empleado;
        return view('prospectos.view', ['prospecto' => $prospecto, 'empleado'=>$empleado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function edit(Prospecto $prospecto)
    {
        $asesores = Empleado::where('cargo', 'Asesor')->get();
        return view('prospectos.edit', ['prospecto' => $prospecto, 'asesores' => $asesores]);
    }

    public function asignarAsesor(Prospecto $prospecto)
    {
        // dd($prospecto);
        $asesores = Empleado::where('cargo', 'Asesor')->get();
        return view('prospectos.asesor.form', ['prospecto' => $prospecto, 'asesores' => $asesores]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prospecto $prospecto)
    {
        // dd($request->all());
        $prospecto->update($request->all());
        return redirect()->route('prospectos.show', ['prospecto' => $prospecto]);
    }
}
