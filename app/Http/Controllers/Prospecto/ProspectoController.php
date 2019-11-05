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
            'tel' => "nullable|numeric",
            'movil' => "nullable|numeric",
            'monto' => "required|numeric",
            'plan' => 'required'
        ];
        // dd($this->validate($request,$rules));
        $prospecto = Prospecto::create($request->all());
        event(new ProspectoCreated($prospecto));
        return redirect()->route('prospecto.create', ['alert' => ['status' => "success", 'message' => "Muy pronto un asesor se comunicará contigo"]]);
        // dd($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('aqui');
        $rules = [
            'nombre' => 'required|max:191',
            'appaterno' => 'required|max:191',
            'apmaterno' => 'nullable|max:191',
            'sexo' => 'nullable|in:,Hombre,Mujer',
            'email' => "required|e-mail",
            'tel' => "nullable|numeric",
            'movil' => "nullable|numeric",
            'sueldo' => 'required|numeric',
            'ahorro' => 'required|numeric',
            'calificacion' => 'required|numeric',
            'aprobado' => 'required|boolean',
            'monto' => 'required|numeric',
            'gastos' => 'required|numeric',
            'plan' => ' required|in:15 años,10 años,6 años,5 años,3 años',
        ];
        $this->validate($request, $rules);
        $prospecto = new Prospecto($request->all());
        $prospecto->empleado_id = (Auth::user()->empleado->id == 1 ? null : Auth::user()->empleado->id);
        $prospecto->sueldo = $request->sueldo;
        $prospecto->ahorro = $request->ahorro;
        $prospecto->gastos = $request->gastos;
        $prospecto->calificacion = $request->calificacion;
        $prospecto->aprobado = $request->aprobado;
        $prospecto->monto = $request->monto;
        $prospecto->plan = $request->plan;
        $prospecto->save();

        // $PerfilDatosPersonalCliente = PerfilDatosPersonalCliente::create([
        //     "prospecto_id"=>$prospecto->id,
        //     "empleado_id"=>$prospecto->empleado_id,
        //     "salario_1"=>$prospecto->sueldo,
        //     "ahorros"=>$prospecto->ahorro,
        //     "plan"=>$prospecto->plan,
        // ]);

        // dd($PerfilDatosPersonalCliente);

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
