<?php
namespace App\Filament\Resources\PartnershipRequestResource\Pages;

use App\Filament\Resources\PartnershipRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPartnershipRequest extends EditRecord
{
    protected static string $resource = PartnershipRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Automatically set review info when status changes
        if ($data['status'] !== $this->record->getOriginal('status')) {
            $data['reviewed_at'] = now();
            $data['reviewed_by'] = auth()->id();
        }

        return $data;
    }
}