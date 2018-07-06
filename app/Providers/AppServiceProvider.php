<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Fixes "Specified key was too long" error.
        Schema::defaultStringLength(191);

        // Set the default currency for the cashier.
        Cashier::useCurrency('usd', '$');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Load the IDE Helpers for non-production mode only.
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
