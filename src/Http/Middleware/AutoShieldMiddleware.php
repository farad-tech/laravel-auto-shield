<?php

namespace FaradTech\LaravelAutoShield\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use FaradTech\LaravelAutoShield\Services\IpService\Ipv4Service;
use FaradTech\LaravelAutoShield\Services\IpService\Ipv6Service;
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
        /**
         * Check if Laravel Auto Shield enabled or not
         */
        if(Config::get(key: 'laravelautoshield.enabled') == false)
        {
            return $next($request);
        }

        /**
         * Determine which IP address to use for Auto Shield checks
         * ----------------------------------------------------------
         * Laravel Auto Shield can operate in two modes regarding IP detection:
         *
         * 1. Real IP mode (`based_on_real_ip = true`)
         *    - Uses the actual client IP, even if the user is behind a proxy,
         *      load balancer, or Cloudflare.
         *    - This is obtained via the `autoShieldRealIp()` helper function.
         *
         * 2. Default IP mode (`based_on_real_ip = false`)
         *    - Uses the server-detected IP (`$request->ip()`), which may be
         *      the IP of a proxy or NAT device rather than the client.
         * 
         *
         * @var string $ip  The client IP address according to the chosen mode
         */
        $ip = (Config::get(key: 'laravelautoshield.based_on_real_ip')) ?
            autoShieldRealIp(request: $request) :
            $request->ip();

        
        /**
         * Choose the appropriate IP service based on the IP version
         * ----------------------------------------------------------
         * Laravel Auto Shield distinguishes between IPv4 and IPv6 addresses
         * because some operations
         * may differ depending on the IP version.
         *
         * 1. If the IP is IPv6 (`autoShieldIsIpV6($ip)` returns true):
         *    - An instance of `Ipv6Service` is created to handle IPv6-specific logic.
         *
         * 2. If the IP is IPv4:
         *    - An instance of `Ipv4Service` is created for IPv4-specific logic.
         *
         * After selecting the appropriate service, the IP is saved using:
         *    $ipService->save($ip);
         *
         * This ensures that IPs are stored and processed correctly according to
         * their version.
         *
         * @var Ipv4Service|Ipv6Service $ipService  The service instance handling this IP
         */
        if(autoShieldIsIpV6(ip: $ip))
        {
            $ipService = new Ipv6Service();
        } else {
            $ipService = new Ipv4Service();
        }
        $ipService->save($ip);

        return $next($request);
    }
}