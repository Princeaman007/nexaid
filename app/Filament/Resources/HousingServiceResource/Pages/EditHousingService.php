<?php

namespace App\Filament\Resources\HousingServiceResource\Pages;

use App\Filament\Resources\HousingServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHousingService extends EditRecord
{
    protected static string $resource = HousingServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
