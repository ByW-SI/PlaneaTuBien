<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class PrecargasMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $component)
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
