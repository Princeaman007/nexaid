<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Css;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
{
    FilamentAsset::register([
        Css::make('custom-admin', __DIR__ . '/../../resources/css/custom-admin.css'),
    ]);
}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
