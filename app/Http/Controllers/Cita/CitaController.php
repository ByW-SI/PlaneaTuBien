<?php

namespace App\Http\Controllers\Cita;

use App\Citas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Cita\StoreCitaService;

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
}
