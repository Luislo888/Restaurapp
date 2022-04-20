<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class MiddleCocinero
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {
        switch (auth::user()->rol) {
            case ('1'):
                return $next($request); // si es administrador puede ver la vista cocinero
                break;
            case ('2'):
                return redirect('camarero'); /// si es un camareroredirige a la ruta camarero
                break;
            case ('3'):
                return $next($request); //si es cocinero continua a su ruta cocinero
                break;
        }
    }
}
