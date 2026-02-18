<?php

namespace Tests\Feature\Middleware;

use FaradTech\LaravelAutoShield\Models\AutoShieldRequest;
use Tests\TestCase;

class AutoShieldMiddlewareTest extends TestCase
{

    /**
     * Routes defined at \Tests\TestCase::class
     * @return void
     */
    public function test_authshield_middleware_should_record_request(): void
    {

        $oldRecordsCount = AutoShieldRequest::count();
        $this->get('/test-auto-shield');
        $newRecordsCount = AutoShieldRequest::count();

        $diff = $newRecordsCount - $oldRecordsCount;

        $this->assertEquals(1, $diff);

    }

}