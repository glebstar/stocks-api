<?php

namespace App\Providers;

use App\Interfaces\StockProviderInterface;
use App\StockProviders\StubProvider;
use Illuminate\Support\ServiceProvider;

class StockProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StockProviderInterface::class, StubProvider::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
