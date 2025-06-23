<?php
namespace App\Filament\Widgets;

use App\Models\PartnershipRequest;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class PartnershipRequestsChart extends ChartWidget
{
    protected static ?string $heading = 'Partnership Requests Trend';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = [];
        $labels = [];
        
        // Get data for the last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $count = PartnershipRequest::whereYear('created_at', $date->year)
                                     ->whereMonth('created_at', $date->month)
                                     ->count();
            
            $data[] = $count;
            $labels[] = $date->format('M Y');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Partnership Requests',
                    'data' => $data,
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
