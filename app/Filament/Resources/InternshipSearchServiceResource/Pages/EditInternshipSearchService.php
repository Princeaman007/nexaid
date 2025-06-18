<?php

namespace App\Filament\Resources\InternshipSearchServiceResource\Pages;

use App\Filament\Resources\InternshipSearchServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInternshipSearchService extends EditRecord
{
    protected static string $resource = InternshipSearchServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
