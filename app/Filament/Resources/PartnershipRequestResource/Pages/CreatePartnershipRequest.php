<?php
namespace App\Filament\Resources\PartnershipRequestResource\Pages;

use App\Filament\Resources\PartnershipRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePartnershipRequest extends CreateRecord
{
    protected static string $resource = PartnershipRequestResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}