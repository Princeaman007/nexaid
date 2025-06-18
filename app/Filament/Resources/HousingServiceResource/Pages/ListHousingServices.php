<?php

namespace App\Filament\Resources\HousingServiceResource\Pages;

use App\Filament\Resources\HousingServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHousingServices extends ListRecords
{
    protected static string $resource = HousingServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
