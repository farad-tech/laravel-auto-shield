<?php

namespace Src\Services\IpService;

use FaradTech\LaravelAutoShield\Models\AutoShieldRequest;

class Ipv6Service implements IpService
{

    protected function firstPiece(string $ip): string
    {
        return explode(':', $ip)[0];
    }

    public function save(string $ip): void
    {
        AutoShieldRequest::create([
            'ip' => $ip,
            'first_piece' => $this->firstPiece($ip),
            'ip_version' => 6,
            'day_timetamp' => autoShieldTodaySeconds(),
        ]);
    }

}