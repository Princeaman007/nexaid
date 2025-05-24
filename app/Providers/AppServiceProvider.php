<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Css;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

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
        // Appliquer la locale de session si disponible
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            if (in_array($locale, ['fr', 'en'])) {
                App::setLocale($locale);
                logger('AppServiceProvider: Langue définie sur ' . $locale);
            }
        } else {
            // Définir une locale par défaut si aucune n'est en session
            $defaultLocale = config('app.locale', 'fr');
            logger('AppServiceProvider: Aucune langue en session, utilisation de la langue par défaut ' . $defaultLocale);
            App::setLocale($defaultLocale);
        }
    }
}