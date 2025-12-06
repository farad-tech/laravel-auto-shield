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
        $this->loadHelpers();
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

    /**
     * Load Laravel Auto Shield Helpers
     * @return void
     */
    public function loadHelpers(): void
    {
        $helpers = __DIR__ . '/Helpers/laravelautoshield.php';
        if (file_exists($helpers)) {
            require_once $helpers;
        }
    }
}