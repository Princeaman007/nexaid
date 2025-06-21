<?php
namespace App\Filament\Widgets;

use App\Models\CompanyRegistration;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class CompanyRegistrationChart extends ChartWidget
{
    protected static ?string $heading = 'Inscriptions par mois';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = CompanyRegistration::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = collect();
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('Y-m');
            $monthLabel = now()->subMonths($i)->format('M Y');
            $count = $data->firstWhere('month', $month)?->count ?? 0;
            
            $months->push([
                'month' => $monthLabel,
                'count' => $count
            ]);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Inscriptions',
                    'data' => $months->pluck('count')->toArray(),
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                ],
            ],
            'labels' => $months->pluck('month')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}