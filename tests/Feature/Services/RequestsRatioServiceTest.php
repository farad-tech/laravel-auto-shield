<?php

namespace Tests\Feature\Services;

use FaradTech\LaravelAutoShield\Services\IpService\Ipv4Service;
use Tests\TestCase;

use FaradTech\LaravelAutoShield\Services\RequestsRatioService;

class RequestsRatioServiceTest extends TestCase
{

    public function test_previous_requests_counts_is_zero(): void
    {

        $requestRatioService = new RequestsRatioService();
        $count = $requestRatioService->previousPeriodRecords();

        $this->assertEquals(0, $count);
    }

    public function test_current_requests_counts_is_one(): void
    {

        $ipv4Service = new Ipv4Service();
        $ipv4Service->save(fake()->ipv4());

        $requestRatioService = new RequestsRatioService();
        $count = $requestRatioService->currentPeriodRecords();
        
        $this->assertEquals(1, $count);
    }

    public function test_current_requests_counts_is_zero(): void
    {

        $requestRatioService = new RequestsRatioService();
        $count = $requestRatioService->currentPeriodRecords();
        
        $this->assertEquals(0, $count);
    }

}