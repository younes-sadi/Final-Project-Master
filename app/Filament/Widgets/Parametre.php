<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Parametre as ModelsParametre;
use Filament\Widgets\TableWidget as BaseWidget;

class ParametreTested extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return ModelsParametre::query()->latest();
    }
    public static function canView(): bool
    {
        return false;
    }
    protected function getTableColumns(): array
    {
        return [

            TextColumn::make('TemperatureValeur_max')
                ->label('Temperature Valeur Max')->suffix("     °C"),
                TextColumn::make('TemperatureValeur_min')
                ->label('Temperature Valeur Min')->suffix("     °C"),
                TextColumn::make('HumidityValeur')
                ->label('Humidity Valeur')->suffix("     %"),
                TextColumn::make('SoilValeur')
                ->label('Soil Valeur')->suffix("     %"),
                TextColumn::make('LightValeur_max')
                ->label('Light Valeur Max')->suffix("     Lux"),
                TextColumn::make('LightValeur_min')
                ->label('Light Valeur Min')->suffix("     Lux"),
        ];
    }

}
