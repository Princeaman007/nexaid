<?php
namespace App\Filament\Resources\CompanyRegistrationResource\Pages;

use App\Filament\Resources\CompanyRegistrationResource;
use App\Models\CompanyRegistration;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListCompanyRegistrations extends ListRecords
{
    protected static string $resource = CompanyRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('bulk_approve')
                ->label('Approuver sélection')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->action(function (array $data) {
                    CompanyRegistration::whereIn('id', request('selectedRecords', []))
                        ->update(['status' => 'approved']);
                }),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Toutes')
                ->badge(CompanyRegistration::count()),
            'pending' => Tab::make('En attente')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending'))
                ->badge(CompanyRegistration::where('status', 'pending')->count())
                ->badgeColor('warning'),
            'hiring' => Tab::make('Recrutement')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'hiring'))
                ->badge(CompanyRegistration::where('type', 'hiring')->count()),
            'partnership' => Tab::make('Partenariats')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'partnership'))
                ->badge(CompanyRegistration::where('type', 'partnership')->count()),
            'offer_sender' => Tab::make('Publications')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'offer_sender'))
                ->badge(CompanyRegistration::where('type', 'offer_sender')->count()),
        ];
    }
}