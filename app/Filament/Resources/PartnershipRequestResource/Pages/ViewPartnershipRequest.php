<?php
namespace App\Filament\Resources\PartnershipRequestResource\Pages;

use App\Filament\Resources\PartnershipRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Notifications\Notification;

class ViewPartnershipRequest extends ViewRecord
{
    protected static string $resource = PartnershipRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            
            Actions\Action::make('approve')
                ->label('Approve Request')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn (): bool => $this->record->status !== 'approved')
                ->action(function (): void {
                    $this->record->update([
                        'status' => 'approved',
                        'reviewed_at' => now(),
                        'reviewed_by' => auth()->id(),
                    ]);
                    
                    Notification::make()
                        ->title('Partnership request approved successfully')
                        ->success()
                        ->send();
                }),
            
            Actions\Action::make('reject')
                ->label('Reject Request')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->visible(fn (): bool => $this->record->status !== 'rejected')
                ->action(function (): void {
                    $this->record->update([
                        'status' => 'rejected',
                        'reviewed_at' => now(),
                        'reviewed_by' => auth()->id(),
                    ]);
                    
                    Notification::make()
                        ->title('Partnership request rejected')
                        ->danger()
                        ->send();
                }),
                
            Actions\Action::make('mark_contacted')
                ->label('Mark as Contacted')
                ->icon('heroicon-o-phone')
                ->color('info')
                ->visible(fn (): bool => $this->record->status !== 'contacted')
                ->action(function (): void {
                    $this->record->update([
                        'status' => 'contacted',
                        'reviewed_at' => now(),
                        'reviewed_by' => auth()->id(),
                    ]);
                    
                    Notification::make()
                        ->title('Partnership request marked as contacted')
                        ->info()
                        ->send();
                }),
        ];
    }
}