<?php

namespace App\Filament\Resources\AdditionalResource\Pages;

use App\Filament\Resources\AdditionalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdditional extends EditRecord
{
    protected static string $resource = AdditionalResource::class;


    protected function getActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
