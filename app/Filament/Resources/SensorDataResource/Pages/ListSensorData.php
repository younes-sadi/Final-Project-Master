<?php

namespace App\Filament\Resources\SensorDataResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SensorDataResource;
use App\Filament\Resources\SensorDataResource\Widgets\Charts;
use App\Filament\Resources\SensorDataResource\Widgets\Light;
use App\Filament\Resources\SensorDataResource\Widgets\SoilChart;
use App\Filament\Resources\SensorDataResource\Widgets\HumidityChart;
use App\Filament\Resources\SensorDataResource\Widgets\TemperatureChart;

class ListSensorData extends ListRecords
{
    protected static string $resource = SensorDataResource::class;

    protected function getActions(): array
    {
        return [

        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
// TemperatureChart::class,
// HumidityChart::class,
// SoilChart::class,
// Light::class,
Charts::class

        ];
    }

}
