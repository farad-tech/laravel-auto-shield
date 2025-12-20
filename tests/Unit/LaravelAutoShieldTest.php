<?php

namespace Tests\Unit;

use Tests\TestCase;

class LaravelAutoShieldTest extends TestCase
{

    public function test_auto_shield_real_ip_returns_string(): void
    {
        $request = request();

        $this->assertIsString(autoShieldRealIp($request));
    }

    public function test_auto_shield_ip_v6_checker_returns_true(): void
    {
        $ip = fake()->ipv6();

        $this->assertTrue(autoShieldIsIpV6($ip));
    }

    public function test_auto_shield_todays_seconds(): void
    {
        $todaySeconds = autoShieldTodaySeconds();

        $this->assertLessThanOrEqual(60*60*24, $todaySeconds);
        $this->assertGreaterThanOrEqual(0, $todaySeconds);
    }

}