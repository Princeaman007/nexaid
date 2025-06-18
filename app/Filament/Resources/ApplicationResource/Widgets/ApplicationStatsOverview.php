<?php

namespace App\Filament\Resources\ApplicationResource\Widgets;

use App\Models\Application;
use App\Models\Internship;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class ApplicationStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Statistiques de base
        $totalApplications = Application::count();
        $recentApplications = Application::where('created_at', '>=', now()->subDays(7))->count();
        $applicationsWithCV = Application::whereNotNull('cv_path')->count();
        $activeInternships = Internship::where('is_active', true)->count();
        
        // Évolution par rapport à la semaine précédente
        $previousWeekApplications = Application::whereBetween('created_at', [
            now()->subDays(14),
            now()->subDays(7)
        ])->count();
        
        $weeklyGrowth = $previousWeekApplications > 0 
            ? (($recentApplications - $previousWeekApplications) / $previousWeekApplications) * 100
            : ($recentApplications > 0 ? 100 : 0);

        // Taux de candidatures avec CV
        $cvRate = $totalApplications > 0 ? ($applicationsWithCV / $totalApplications) * 100 : 0;

        // Candidature par stage (moyenne)
        $avgApplicationsPerInternship = $activeInternships > 0 
            ? round($totalApplications / $activeInternships, 1)
            : 0;

        return [
            Stat::make('Total des candidatures', $totalApplications)
                ->description('Toutes les candidatures reçues')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary')
                ->chart($this->getWeeklyApplicationsChart()),

            Stat::make('Nouvelles cette semaine', $recentApplications)
                ->description($weeklyGrowth >= 0 ? "+{$weeklyGrowth}% vs semaine précédente" : "{$weeklyGrowth}% vs semaine précédente")
                ->descriptionIcon($weeklyGrowth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($weeklyGrowth >= 0 ? 'success' : 'danger'),

            Stat::make('Avec CV', $applicationsWithCV)
                ->description(round($cvRate, 1) . '% des candidatures')
                ->descriptionIcon('heroicon-m-document-arrow-down')
                ->color('info'),

            Stat::make('Moy. par stage', $avgApplicationsPerInternship)
                ->description("Sur {$activeInternships} stages actifs")
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('warning'),
        ];
    }

    private function getWeeklyApplicationsChart(): array
    {
        $data = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = Application::whereDate('created_at', $date->toDateString())->count();
            $data[] = $count;
        }
        
        return $data;
    }

    protected function getColumns(): int
    {
        return 4;
    }
}