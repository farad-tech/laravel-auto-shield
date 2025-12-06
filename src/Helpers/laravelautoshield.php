<?php

use Illuminate\Http\Request;

/**
 * Get client real IP
 * 
 * 
 * @param Request $request
 * @return string
 */
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
    }
    else {
        $ip = $request->server->get('REMOTE_ADDR');
    }

    return filter_var($ip, FILTER_VALIDATE_IP) ?? $request->ip();
}

/**
 * Check if IP is V6 or not
 * 
 * 
 * @param string $ip
 * @return bool
 */
function autoShieldIsIpV6(string $ip): bool
{
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        return true;
    }
    return false;
}