<?php

namespace App\Filament\Resources\AirportPickupServiceResource\Pages;

use App\Filament\Resources\AirportPickupServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAirportPickupService extends EditRecord
{
    protected static string $resource = AirportPickupServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
