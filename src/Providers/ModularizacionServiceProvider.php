<?php

namespace Ricardo\Modu\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Request;

class ModularizacionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->app->register(SeedServiceProvider::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        // 
    }
}
