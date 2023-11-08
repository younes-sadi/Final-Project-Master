<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Plant;
use App\Models\Season;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\SeasonResource\Pages;
use App\Filament\Resources\SeasonResource\RelationManagers;


class SeasonResource extends Resource
{
    protected static ?string $model = Season::class;
    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-s-document-text';
    protected static ?string $navigationGroup = 'Season';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make("name")->required()->unique()->label("Name")->nullable(false)->visibleOn(['create','view']),
                    Select::make('plant_id')
                    ->label('Plant Name')
                    ->options(Plant::all()->pluck('name', 'id'))
                    ->searchable()->nullable(false)->visibleOn(['create','view']),
                    DatePicker::make('start_day')->nullable(false)->visibleOn(['create','view']),
                    DatePicker::make('end_day')->nullable(false)->visibleOn(['create','view']),
                    TextInput::make('quantity_planty')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   KG")->label("Quantity Planty")->nullable(false)->visibleOn(['create','view']),
                    TextInput::make('expected_productivity')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   KG")->label("Expected Productivity")->nullable(false)->visibleOn(['create','view']),
                    Select::make('4season')->label("Les quatre saisons")
    ->options([
        'printemps' => 'Printemps',
        'été' => 'Été',
        'automne' => 'Automne',
        'hiver' => 'Hiver',
    ])->nullable(false)->visibleOn(['create','view']),
    TextInput::make('productivity')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   KG")->label("Productivity")->placeholder("Please fill this field after the season")->visibleOn(['edit','view']),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label("ID"),
                TextColumn::make('name')->label("Name")->sortable()->searchable(),
                TextColumn::make('plant.name')->label('Plant Name'),
                TextColumn::make('start_day')->date(),
                TextColumn::make('end_day')->date(),
                TextColumn::make('quantity_planty')->suffix("      KG"),
                TextColumn::make('expected_productivity')->suffix("      KG"),
                TextColumn::make('4season')->label("Les quatre saisons"),
                TextColumn::make('productivity')->label("productivity")->suffix("     KG"),
                TextColumn::make('created_at')->dateTime()

            ])
            ->filters([
                SelectFilter::make('4season')->label("Les quatre saisons")
    ->options([
        'printemps' => 'Printemps',
        'été' => 'Été',
        'automne' => 'Automne',
        'hiver' => 'Hiver',
    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

            ])
            ->bulkActions([

            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ParametresRelationManager::class,
            RelationManagers\SensordataRelationManager::class,
            RelationManagers\DeviceRelationManager::class,
            RelationManagers\ExtraRelationManager::class,
            RelationManagers\ObservationRelationManager::class,


        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeasons::route('/'),
            'create' => Pages\CreateSeason::route('/create'),
            'view' => Pages\ViewSeason::route('/{record}'),
            'edit' => Pages\EditSeason::route('/{record}/edit'),
        ];
    }
}
