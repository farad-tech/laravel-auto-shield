<?php

use Illuminate\Http\Request;

/**
 * Get client real IP
 * 
 * 
 * @param Request $request
 * @return string
 */
if (!function_exists('autoShieldRealIp')) {
    function autoShieldRealIp(Request $request): string
    {

        $ip = null;

        // Cloudflare
        if ($request->server->has('HTTP_CF_CONNECTING_IP')) {
            $ip = $request->server->get('HTTP_CF_CONNECTING_IP');
        }
        // X-Forwarded-For
        elseif ($request->server->has('HTTP_X_FORWARDED_FOR')) {
            $ips = explode(',', $request->server->get('HTTP_X_FORWARDED_FOR'));
            $ip = trim(reset($ips));
        } else {
            $ip = $request->server->get('REMOTE_ADDR');
        }

        return filter_var($ip, FILTER_VALIDATE_IP) ?? $request->ip();
    }
}

/**
 * Check if IP is V6 or not
 * 
 * 
 * @param string $ip
 * @return bool
 */
if (!function_exists('autoShieldIsIpV6')) {
    function autoShieldIsIpV6(string $ip): bool
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return true;
        }
        return false;
    }
}

/**
 * Get current time based on seconds
 * 
 * 
 * @return int
 */
if (!function_exists('autoShieldTodaySeconds')) {
    function autoShieldTodaySeconds(): int
    {
        return time() - strtotime('today');
    }
}