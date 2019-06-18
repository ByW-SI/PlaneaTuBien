<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class EmpleadosMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $component=null)
    {
        // dd($next($request));

        if(Auth::check()) {
            foreach (Auth::user()->perfil->componentes as $componente)
                if($componente->nombre == $component)
                    return $next($request);
            return redirect()->route('home');
        } else
            return redirect()->route('login');
    }
}
