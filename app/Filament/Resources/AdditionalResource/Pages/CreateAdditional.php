<?php

namespace App\Filament\Resources\AdditionalResource\Pages;

use App\Filament\Resources\AdditionalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdditional extends CreateRecord
{
    protected static string $resource = AdditionalResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Extras created';
    }
}
