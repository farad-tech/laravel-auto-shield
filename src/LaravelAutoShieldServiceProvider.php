<?php

namespace FaradTech\LaravelAutoShield;

use Illuminate\Support\ServiceProvider;

class LaravelAutoShieldServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {    
        $this->publishes([
            __DIR__.'/../config/laravelautoshield.php' => config_path('autoshield.php'),
        ]);
    }
}