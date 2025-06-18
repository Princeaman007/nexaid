<?php

namespace App\Filament\Resources\InternshipSearchServiceResource\Pages;

use App\Filament\Resources\InternshipSearchServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInternshipSearchServices extends ListRecords
{
    protected static string $resource = InternshipSearchServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
