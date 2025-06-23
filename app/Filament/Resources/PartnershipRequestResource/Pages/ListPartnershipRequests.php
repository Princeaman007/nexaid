<?php
namespace App\Filament\Resources\PartnershipRequestResource\Pages;

use App\Filament\Resources\PartnershipRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListPartnershipRequests extends ListRecords
{
    protected static string $resource = PartnershipRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Requests'),
            
            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending'))
                ->badge(fn () => $this->getModel()::where('status', 'pending')->count())
                ->badgeColor('warning'),
            
            'in_review' => Tab::make('In Review')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'in_review'))
                ->badge(fn () => $this->getModel()::where('status', 'in_review')->count())
                ->badgeColor('info'),
            
            'approved' => Tab::make('Approved')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'approved'))
                ->badge(fn () => $this->getModel()::where('status', 'approved')->count())
                ->badgeColor('success'),
            
            'contacted' => Tab::make('Contacted')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'contacted'))
                ->badge(fn () => $this->getModel()::where('status', 'contacted')->count())
                ->badgeColor('primary'),
            
            'rejected' => Tab::make('Rejected')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'rejected'))
                ->badge(fn () => $this->getModel()::where('status', 'rejected')->count())
                ->badgeColor('danger'),
        ];
    }
}