<?php
namespace App\Filament\Resources\CompanyRegistrationResource\Pages;

use App\Filament\Resources\CompanyRegistrationResource;
use App\Models\CompanyRegistration;
use App\Notifications\RegistrationApprovedNotification;
use App\Notifications\RegistrationRejectedNotification;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Notifications\Notification;

class ViewCompanyRegistration extends ViewRecord
{
    protected static string $resource = CompanyRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            
            Actions\Action::make('approve')
                ->label('Approuver')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->modalDescription('Êtes-vous sûr de vouloir approuver cette inscription ?')
                ->action(function (CompanyRegistration $record) {
                    $record->update(['status' => 'approved']);
                    $record->company->update(['status' => 'active']);
                    
                    // Notification à l'entreprise
                    $record->company->notify(new RegistrationApprovedNotification($record));
                    
                    Notification::make()
                        ->title('Inscription approuvée')
                        ->success()
                        ->send();
                })
                ->visible(fn (CompanyRegistration $record) => $record->status === 'pending'),
            
            Actions\Action::make('reject')
                ->label('Rejeter')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->form([
                    \Filament\Forms\Components\Textarea::make('rejection_reason')
                        ->label('Motif du rejet')
                        ->required()
                        ->rows(3),
                ])
                ->action(function (CompanyRegistration $record, array $data) {
                    $record->update([
                        'status' => 'rejected',
                        'data' => array_merge($record->data ?? [], [
                            'rejection_reason' => $data['rejection_reason']
                        ])
                    ]);
                    
                    // Notification à l'entreprise
                    $record->company->notify(new RegistrationRejectedNotification($record, $data['rejection_reason']));
                    
                    Notification::make()
                        ->title('Inscription rejetée')
                        ->danger()
                        ->send();
                })
                ->visible(fn (CompanyRegistration $record) => $record->status === 'pending'),
        ];
    }
}