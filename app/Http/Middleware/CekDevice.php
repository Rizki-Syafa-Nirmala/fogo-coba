<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Closure;


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
            } else if ($agent->isDesktop() && $request->routeIs('mobile.*')) {
                return redirect()->route('foods'); // asumsi ini route untuk desktop
            }
        } elseif (!auth()->check()) {

            if ($agent->isMobile() && ! $request->routeIs('mobile.*')) {
                return redirect()->route('mobile.install');
            } else if ($agent->isDesktop() && $request->routeIs('mobile.*')) {
                return redirect()->route('guest.home'); // asumsi ini route untuk desktop
            }
        }

        return $next($request);
    }
}

