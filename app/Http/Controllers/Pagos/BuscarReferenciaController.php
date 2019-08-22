<?php

namespace App\Http\Controllers\Pagos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuscarReferenciaController extends Controller
{
    public function index(){
        return view('pagos.referencia.index');
    }
}
