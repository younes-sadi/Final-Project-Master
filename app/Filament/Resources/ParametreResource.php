<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Parametre;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\BelongsToSelect;
use App\Filament\Resources\ParametreResource\Pages;
use App\Filament\Resources\ParametreResource\RelationManagers\SeasonRelationManager;
use App\Models\Season;

class ParametreResource extends Resource
{
    protected static ?string $model = Parametre::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments';
    protected static ?string $navigationGroup = 'Parametre';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('season_id')
                    ->label('Season Name')
                    ->options(Season::all()->pluck('name', 'id'))
                    ->searchable()->unique(),
                    TextInput::make("TemperatureValeur")->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true)->minValue(15)->maxValue(35))->suffix("°C")->nullable(false),
                    TextInput::make("HumidityValeur")->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true)->minValue(20)->maxValue(100))->suffix("%")->nullable(false),
                    TextInput::make("SoilValeur")->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true)->minValue(20)->maxValue(100))->suffix("%")->nullable(false),
                    TextInput::make("LightValeur")->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true)->minValue(10000)->maxValue(20000))->suffix("lux")->nullable(false),
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label("ID")->sortable(),
                TextColumn::make('season.name')->label("Season Name"),
                TextColumn::make('TemperatureValeur')->suffix("   °C"),
                TextColumn::make('HumidityValeur')->suffix("   %"),
                TextColumn::make('SoilValeur')->suffix("   %"),
                TextColumn::make('LightValeur')->suffix("    lux")
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
           SeasonRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListParametres::route('/'),
            'create' => Pages\CreateParametre::route('/create'),
            'edit' => Pages\EditParametre::route('/{record}/edit'),
        ];
    }
}
