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
        // Kalo dia udah login DAN statusnya admin, silakan masuk
        if (auth()->check() && auth()->user()->is_admin == 1) {
            return $next($request);
        }

        // Kalo kroco, tendang!
        abort(403, 'Mao ngapain lu nyet? Lu bukan admin!');
    }
}