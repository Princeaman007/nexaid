<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Company;

class ListCompanies extends ListRecords
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Toutes'),
            
            'hiring' => Tab::make('Recrutement')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', Company::TYPE_HIRING))
                ->badge(Company::hiring()->count()),
                
            'partnership' => Tab::make('Partenariat')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', Company::TYPE_PARTNERSHIP))
                ->badge(Company::partnership()->count()),
                
            'offers' => Tab::make('Offres')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', Company::TYPE_OFFER_SENDER))
                ->badge(Company::offerSender()->count()),
                
            'verified' => Tab::make('Vérifiées')
                ->modifyQueryUsing(fn (Builder $query) => $query->verified())
                ->badge(Company::verified()->count()),
        ];
    }
}
