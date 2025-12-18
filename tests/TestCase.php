<?php

namespace Tests;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Concerns\WithWorkbench;
use PDO;
use function Orchestra\Testbench\workbench_path;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use WithWorkbench, RefreshDatabase;

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string<\Illuminate\Support\ServiceProvider>>
     */
    protected function getPackageProviders($app) 
    {
        return [
            'FaradTech\LaravelAutoShield\LaravelAutoShieldServiceProvider',
        ];
    }

    /**
     * Ignore package discovery from.
     *
     * @return array<int, string>
     */
    public function ignorePackageDiscoveriesFrom() 
    {
        return [];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetup($app) 
    {
        tap($app['config'], function (Repository $config) {
            $config->set('database.connections.testbench', [

                'driver' => 'mysql',
                'url' => null,
                'host' => '127.0.0.1',
                'port' => '3306',
                'database' => 'testbench_testing_dev',
                'username' => 'farhad',
                'password' => '',
                'unix_socket' => env('DB_SOCKET', ''),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'prefix_indexes' => true,
                'strict' => true,
                'engine' => null,
                'options' => extension_loaded('pdo_mysql') ? array_filter([
                    PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                ]) : [],

            ]);
            
            $config->set('database.default', 'testbench');
        });
    }

    /**
     * Define database migrations.
     *
     * @return void
     */
    protected function defineDatabaseMigrations() 
    {
        $this->loadMigrationsFrom(
            workbench_path('../src/database/migrations')
        );
    }
}