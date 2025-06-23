<?php

namespace App\Filament\Widgets;

use App\Models\PartnershipRequest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PartnershipRequestsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $total = PartnershipRequest::count();
        $pending = PartnershipRequest::where('status', 'pending')->count();
        $approved = PartnershipRequest::where('status', 'approved')->count();
        $thisMonth = PartnershipRequest::whereMonth('created_at', now()->month)
                                     ->whereYear('created_at', now()->year)
                                     ->count();
        
        $lastMonth = PartnershipRequest::whereMonth('created_at', now()->subMonth()->month)
                                     ->whereYear('created_at', now()->subMonth()->year)
                                     ->count();
        
        $monthlyChange = $lastMonth > 0 ? round((($thisMonth - $lastMonth) / $lastMonth) * 100, 1) : 0;
        
        return [
            Stat::make('Total Requests', $total)
                ->description('All partnership requests')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('primary'),
            
            Stat::make('Pending Requests', $pending)
                ->description('Awaiting review')
                ->descriptionIcon('heroicon-m-clock')
                ->color($pending > 10 ? 'danger' : ($pending > 5 ? 'warning' : 'success'))
                ->url('/admin/partnership-requests?activeTab=pending'),
            
            Stat::make('Approved This Month', $approved)
                ->description('Successful partnerships')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            
            Stat::make('This Month', $thisMonth)
                ->description($monthlyChange >= 0 ? "+{$monthlyChange}% increase" : "{$monthlyChange}% decrease")
                ->descriptionIcon($monthlyChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($monthlyChange >= 0 ? 'success' : 'danger'),
        ];
    }
}