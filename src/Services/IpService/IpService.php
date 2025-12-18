<?php

namespace FaradTech\LaravelAutoShield\Services\IpService;

use FaradTech\LaravelAutoShield\Models\AutoShieldRequest;
use Src\Dto\IpStoreDto;

interface IpService
{

    public function firstPiece(string $ip): string;

    public function save(string $ip);

}