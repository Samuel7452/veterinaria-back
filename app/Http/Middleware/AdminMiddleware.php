<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->user_type_id === 3) {
            return $next($request);
        }

        abort(403, 'Acceso denegado.');
    }
}