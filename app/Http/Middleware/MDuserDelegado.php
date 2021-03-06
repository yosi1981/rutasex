<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class MDuserDelegado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       $usuarioActual=\Auth::user();
        if($usuarioActual->tipo_usuario!=3)
        {
            return Redirect::to('home');
        }
        return $next($request);
    }
}
