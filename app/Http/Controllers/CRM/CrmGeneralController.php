<?php

namespace App\Http\Controllers\CRM;

use App\Empleado;
use App\Http\Controllers\Controller;
use App\Prospecto;
use App\ProspectoCRM;
use App\Task;
use App\TaskSendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrmGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $empleado = Auth::user()->empleado;

         if($request->desde && $request->hasta){
            $crms = ProspectoCRM::whereBetween('fecha_contacto',[$request->desde,$request->hasta])->orderBy('fecha_aviso','asc')->get();
        }
        elseif ($request->desde && !$request->hasta) {
            // dd("si entra");
            $crms = ProspectoCRM::where('fecha_contacto','>=',$request->desde)->orderBy('fecha_aviso','asc')->get();
        }
        elseif ($request->hasta && !$request->desde) {
            // dd("si entra");
            $crms = ProspectoCRM::where('fecha_contacto','<=',$request->hasta)->orderBy('fecha_aviso','asc')->get();
        }
        else{
            $crms = ProspectoCRM::orderBy('fecha_aviso','asc')->get();
            
        }

         $crms = ProspectoCRM::get();
        return view('crm.index', ['crms' => $crms, 'empleado' => $empleado]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
