<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Solo usuarios logueados con rol 'admin'
        if (Auth::check() && Auth::user()->rol === 'admin') {
            return $next($request);
        }

        abort(403, 'Acceso no autorizado');
    }
}
