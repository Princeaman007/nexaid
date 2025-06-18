<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use App\Models\Application;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListApplications extends ListRecords
{
    protected static string $resource = ApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nouvelle candidature')
                ->icon('heroicon-m-plus'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ApplicationResource\Widgets\ApplicationStatsOverview::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Toutes')
                ->badge(Application::count())
                ->badgeColor('primary'),
            
            'pending' => Tab::make('En attente')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending'))
                ->badge(Application::where('status', 'pending')->count())
                ->badgeColor('warning'),
            
            'interview_scheduled' => Tab::make('Entretiens')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'interview_scheduled'))
                ->badge(Application::where('status', 'interview_scheduled')->count())
                ->badgeColor('info'),
            
            'accepted' => Tab::make('Acceptées')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'accepted'))
                ->badge(Application::where('status', 'accepted')->count())
                ->badgeColor('success'),
            
            'rejected' => Tab::make('Refusées')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'rejected'))
                ->badge(Application::where('status', 'rejected')->count())
                ->badgeColor('danger'),
            
            'recent' => Tab::make('Récentes (7 jours)')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subDays(7)))
                ->badge(Application::where('created_at', '>=', now()->subDays(7))->count())
                ->badgeColor('gray'),
        ];
    }
}