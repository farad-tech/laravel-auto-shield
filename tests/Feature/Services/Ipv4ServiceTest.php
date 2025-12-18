<?php

namespace Tests\Feature\Services;

use FaradTech\LaravelAutoShield\Models\AutoShieldRequest;
use FaradTech\LaravelAutoShield\Services\IpService\Ipv4Service;
use Tests\TestCase;

class Ipv4ServiceTest extends TestCase
{

    public function test_save_ip_v4_saves_ip_correctly(): void
    {

        $ip = fake()->ipv4();
        $service = new Ipv4Service();
        $service->save($ip);

        $record = AutoShieldRequest::first();
        
        $this->assertEquals($record->ip, $ip);
    }

    public function test_save_ip_v4_saves_ip_first_octet_correctly(): void
    {

        $ip = fake()->ipv4();
        $service = new Ipv4Service();
        $service->save($ip);
        $ipFirstOctet = $service->firstPiece($ip);

        $record = AutoShieldRequest::first();
        
        $this->assertEquals($ipFirstOctet, $service->firstPiece($record->ip));
    }

    public function test_save_ip_v4_saves_day_timestamp_as_integer(): void
    {

        $ip = fake()->ipv4();
        $service = new Ipv4Service();
        $service->save($ip);

        $record = AutoShieldRequest::first();
        
        $this->assertIsInt($record->day_timestamp);
    }

    public function test_save_ip_v4_saves_ip_version_to_4(): void
    {

        $ip = fake()->ipv4();
        $service = new Ipv4Service();
        $service->save($ip);

        $record = AutoShieldRequest::first();
        
        $this->assertEquals(4, $record->ip_version);
    }

}