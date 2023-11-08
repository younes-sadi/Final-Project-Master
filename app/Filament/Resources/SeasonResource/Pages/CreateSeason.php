<?php

namespace App\Filament\Resources\SeasonResource\Pages;

use App\Filament\Resources\SeasonResource;
use App\Models\Observation;
use App\Models\Parametre;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSeason extends CreateRecord
{
    protected static string $resource = SeasonResource::class;

    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
protected function getSavedNotificationTitle(): ?string
{
    return 'Season created';
}
protected function afterCreate(): void
{
    $season = $this->record;
    Parametre::create([
        'season_id'=>$season->id,
        'TemperatureValeur_max'=>28,
        'TemperatureValeur_min'=>15,
        'HumidityValeur'=>75,
        'SoilValeur'=>40,
        'LightValeur_max'=>20000,
        'LightValeur_min'=>10000,
    ]);
    Observation::create([
        'season_id'=>$season->id
    ]);

}
}
