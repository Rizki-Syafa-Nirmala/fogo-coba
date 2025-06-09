<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Jenssegers\Agent\Agent;


class CekDevice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Jika user sudah login dan dia admin, jangan redirect ke mobile
        $agent = new Agent();
        if (auth()->check() && !auth()->user()->is_admin) {

            if ($agent->isMobile() && ! $request->routeIs('mobile.*')) {
                return redirect()->route('mobile.foods');
            }
        }
        return $next($request);
    }
}

