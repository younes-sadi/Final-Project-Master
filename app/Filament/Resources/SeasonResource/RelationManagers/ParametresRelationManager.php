<?php

namespace App\Filament\Resources\SeasonResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Season;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;

class ParametresRelationManager extends RelationManager
{
    protected static string $relationship = 'parametres';

    protected static ?string $recordTitleAttribute = 'season_id.name';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Select::make('season_id')
                ->label('Season Name')
                ->options(Season::all()->pluck('name', 'id'))->unique() ->visibleOn('create')
                ->searchable(),
                    TextInput::make("TemperatureValeur_max")->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true)->minValue(15)->maxValue(35))->suffix("°C")->nullable(false),
                    TextInput::make("TemperatureValeur_min")->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true)->minValue(15)->maxValue(35))->suffix("°C")->nullable(false),
                    TextInput::make("HumidityValeur")->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true)->minValue(20)->maxValue(100))->suffix("%")->nullable(false),
                    TextInput::make("SoilValeur")->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true)->minValue(20)->maxValue(100))->suffix("%")->nullable(false),
                    TextInput::make("LightValeur_max")->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true)->minValue(10000)->maxValue(20000))->suffix("lux")->nullable(false),
                    TextInput::make("LightValeur_min")->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true)->minValue(10000)->maxValue(20000))->suffix("lux")->nullable(false),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label("ID")->sortable(),
                TextColumn::make('TemperatureValeur_max')->suffix("   °C")->sortable(),
                TextColumn::make('TemperatureValeur_min')->suffix("   °C")->sortable(),
                TextColumn::make('HumidityValeur')->suffix("   %")->sortable(),
                TextColumn::make('SoilValeur')->suffix("   %")->sortable(),
                TextColumn::make('LightValeur_max')->suffix("    lux")->sortable(),
                TextColumn::make('LightValeur_min')->suffix("    lux")->sortable()
            ])
            ->filters([
                //
            ])
            ->headerActions([

                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([

                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([

            ]);
    }
}
