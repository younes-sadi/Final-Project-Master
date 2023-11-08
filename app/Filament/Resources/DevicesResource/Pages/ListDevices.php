<?php

namespace App\Filament\Resources\DevicesResource\Pages;

use App\Filament\Resources\DevicesResource;
use App\Filament\Widgets\DevicesStatsOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDevices extends ListRecords
{
    protected static string $resource = DevicesResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
    // protected function getHeaderWidgets(): array
    // {
    //     return [
    //         DevicesStatsOverview::class,
    //     ];
    // }
}
