<?php

namespace App\Filament\Resources\ParametreResource\Pages;

use App\Filament\Resources\ParametreResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateParametre extends CreateRecord
{
    protected static string $resource = ParametreResource::class;



    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getSavedNotificationTitle(): ?string
{
    return 'Parametre created';
}

}
