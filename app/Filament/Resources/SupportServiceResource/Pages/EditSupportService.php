<?php

namespace App\Filament\Resources\SupportServiceResource\Pages;

use App\Filament\Resources\SupportServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSupportService extends EditRecord
{
    protected static string $resource = SupportServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
