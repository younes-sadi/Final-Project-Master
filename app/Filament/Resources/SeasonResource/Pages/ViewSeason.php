<?php

namespace App\Filament\Resources\SeasonResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\SeasonResource;
use App\Filament\Resources\SeasonResource\Widgets\ParametrePlant;

class ViewSeason extends ViewRecord
{
    protected static string $resource = SeasonResource::class;

    protected function getFooterWidgets(): array
    {
        return [
       ParametrePlant::class


        ];
    }
}
