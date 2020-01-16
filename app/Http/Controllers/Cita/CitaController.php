<?php

namespace App\Http\Controllers\Cita;

use App\Citas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Cita\StoreCitaService;
use App\Services\Cita\UpdateCitaService;

class CitaController extends Controller
{

    public function index()
    {
        $citas = Citas::get();
        return view('citas.index', compact('citas'));
    }

    public function store(Request $request)
    {
        $storeCitaService = new StoreCitaService($request);
        return redirect()->back();
    }

    public function update(Request $request, $id){
        $cita = Citas::find($id);
        $updateCitaService = new UpdateCitaService($request, $cita);
        return redirect()->route('citas.confirmadas');
    }

    public function confirmadas(){
        $citas = Citas::confirmadas()->get();
        return view('citas.confirmadas.index', compact('citas'));

    }
}
