<?php

namespace App\Filament\Resources\AirportPickupServiceResource\Pages;

use App\Filament\Resources\AirportPickupServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAirportPickupServices extends ListRecords
{
    protected static string $resource = AirportPickupServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
