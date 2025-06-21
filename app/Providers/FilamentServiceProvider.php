<?php
namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label('Gestion')
                    ->icon('heroicon-o-cog-6-tooth'),
                NavigationGroup::make()
                    ->label('Stages')
                    ->icon('heroicon-o-academic-cap'),
                NavigationGroup::make()
                    ->label('Public')
                    ->icon('heroicon-o-globe-alt'),
                NavigationGroup::make()
                    ->label('Statistiques')
                    ->icon('heroicon-o-chart-bar'),
            ]);
        });
    }
}
