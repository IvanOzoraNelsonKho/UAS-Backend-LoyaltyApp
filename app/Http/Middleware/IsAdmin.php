<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        if (auth()->check() && auth()->user()->is_admin == 1) {
            return $next($request);
        }

       
        abort(403, 'Mao ngapain lu nyet? Lu bukan admin!');
    }
}