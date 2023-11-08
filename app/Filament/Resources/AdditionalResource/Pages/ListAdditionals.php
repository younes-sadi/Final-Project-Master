<?php

namespace App\Filament\Resources\AdditionalResource\Pages;

use App\Filament\Resources\AdditionalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdditionals extends ListRecords
{
    protected static string $resource = AdditionalResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
