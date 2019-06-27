<?php

namespace App\Http\Middleware;

use Closure;

class SucursalMiddleware
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
        if(Auth::check()) {
            foreach (Auth::user()->perfil->componentes as $componente)
                if($componente->nombre == $component)
                    return $next($request);
            return redirect()->route('denegado');
        } else
            return redirect()->route('login');
    }
}
