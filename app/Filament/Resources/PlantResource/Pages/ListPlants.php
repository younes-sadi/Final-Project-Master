<?php

namespace App\Filament\Resources\PlantResource\Pages;

use Filament\Pages\Actions;

use App\Filament\Resources\PlantResource;
use Filament\Resources\Pages\ListRecords;

class ListPlants extends ListRecords
{
    protected static string $resource = PlantResource::class;



    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
