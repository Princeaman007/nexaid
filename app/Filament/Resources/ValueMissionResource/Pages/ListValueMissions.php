<?php

namespace App\Filament\Resources\ValueMissionResource\Pages;

use App\Filament\Resources\ValueMissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListValueMissions extends ListRecords
{
    protected static string $resource = ValueMissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
