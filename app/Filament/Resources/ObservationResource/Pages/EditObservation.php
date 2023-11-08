<?php

namespace App\Filament\Resources\ObservationResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ObservationResource;
use App\Filament\Resources\ObservationResource\Widgets\ParametrePlant;

class EditObservation extends EditRecord
{
    protected static string $resource = ObservationResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
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
