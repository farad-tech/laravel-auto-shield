<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class AutoShieldMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Config::get(key: 'laravelautoshield.enabled') == false)
        {
            return $next($request);
        }

        $ip = (Config::get(key: 'laravelautoshield.based_on_real_ip')) ?
            autoShieldRealIp(request: $request) :
            $request->ip();

        // if(autoShieldIsIpV6(ip: $ip))
        // {
            
        // }

        return $next($request);
    }
}