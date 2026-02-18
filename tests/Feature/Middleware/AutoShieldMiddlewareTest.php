<?php

namespace Tests\Feature\Middleware;

use FaradTech\LaravelAutoShield\Models\AutoShieldRequest;
use FaradTech\LaravelAutoShield\Services\RequestsRatioService;
use Tests\TestCase;

class AutoShieldMiddlewareTest extends TestCase
{

    /**
     * Routes defined at \Tests\TestCase::class
     * @return void
     */
    public function test_autoshield_middleware_should_record_request(): void
    {

        $oldRecordsCount = AutoShieldRequest::count();
        $this->get('/test-auto-shield');
        $newRecordsCount = AutoShieldRequest::count();

        $diff = $newRecordsCount - $oldRecordsCount;

        $this->assertEquals(1, $diff);

    }

    public function test_autoshield_middleware_and_check_with_ratio_service_returns_4()
    {
        $this->get('/test-auto-shield');
        $this->get('/test-auto-shield');
        $this->get('/test-auto-shield');
        $this->get('/test-auto-shield');

        $requestRatioService = new RequestsRatioService();
        $count =$requestRatioService->currentPeriodRecords();

        $this->assertEquals(4, $count);
    }

}