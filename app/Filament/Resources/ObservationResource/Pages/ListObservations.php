<?php

namespace App\Filament\Resources\ObservationResource\Pages;

use App\Filament\Resources\ObservationResource;
use App\Filament\Resources\ObservationResource\Widgets\ParametrePlant;
use App\Filament\Resources\ObservationResource\Widgets\PlantParametres;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObservations extends ListRecords
{
    protected static string $resource = ObservationResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
    // protected function getHeaderWidgets(): array
    // {
    //     return [
    //    ParametrePlant::class
    // // PlantParametres::class,


    //     ];
    // }
}
