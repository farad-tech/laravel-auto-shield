<?php

namespace Tests\Feature\Services;

use FaradTech\LaravelAutoShield\Models\AutoShieldRequest;
use FaradTech\LaravelAutoShield\Services\IpService\Ipv6Service;
use Tests\TestCase;

class Ipv6ServiceTest extends TestCase
{

    public function test_save_ip_v6_saves_ip_correctly(): void
    {

        $ip = fake()->ipv6();
        $service = new Ipv6Service();
        $service->save($ip);

        $record = AutoShieldRequest::first();
        
        $this->assertEquals($record->ip, $ip);
    }

    public function test_save_ip_v6_saves_ip_first_octet_correctly(): void
    {

        $ip = fake()->ipv6();
        $service = new Ipv6Service();
        $service->save($ip);
        $ipFirstOctet = $service->firstPiece($ip);

        $record = AutoShieldRequest::first();
        
        $this->assertEquals($ipFirstOctet, $service->firstPiece($record->ip));
    }

    public function test_save_ip_v6_saves_day_timestamp_as_integer(): void
    {

        $ip = fake()->ipv6();
        $service = new Ipv6Service();
        $service->save($ip);

        $record = AutoShieldRequest::first();
        
        $this->assertIsInt($record->day_timestamp);
    }

    public function test_save_ip_v6_saves_ip_version_to_6(): void
    {

        $ip = fake()->ipv6();
        $service = new Ipv6Service();
        $service->save($ip);

        $record = AutoShieldRequest::first();
        
        $this->assertEquals(6, $record->ip_version);
    }

}