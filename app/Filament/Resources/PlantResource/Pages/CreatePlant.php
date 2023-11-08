<?php

namespace App\Filament\Resources\PlantResource\Pages;

use App\Filament\Resources\PlantResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePlant extends CreateRecord
{
    protected static string $resource = PlantResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Plant created';
    }
}
