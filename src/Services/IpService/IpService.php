<?php

namespace Src\Services\IpService;

use FaradTech\LaravelAutoShield\Models\AutoShieldRequest;
use Src\Dto\IpStoreDto;

interface IpService
{

    protected function firstPiece(string $ip): string;

    public function save(string $ip);

}