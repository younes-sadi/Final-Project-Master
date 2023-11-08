<?php

namespace App\Providers;


use Filament\Facades\Filament;
use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {


        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        Filament::serving(function () {
            // Using Vite
            Filament::registerTheme(
                app(Vite::class)('resources/css/app.css'),
            );
        });
    }
}
