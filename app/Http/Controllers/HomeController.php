<?php

namespace App\Http\Controllers;
use User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function restablecer()
    {
        $Usuario=User::where('id',1)->first();
        $Usuario->update(['password' => bcrypt('3@V%pOvFQ8Mw') ]);
    }
}
