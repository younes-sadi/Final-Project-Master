<?php

namespace App\Filament\Resources\PlantResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Plant;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class SeasonRelationManager extends RelationManager
{
    protected static string $relationship = 'season';

    protected static ?string $recordTitleAttribute = 'name';

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
                // Tables\Columns\TextColumn::make('name'),
                TextColumn::make('id')->label("ID"),
                TextColumn::make('name')->label("Name")->sortable()->searchable(),
                TextColumn::make('start_day')->date(),
                TextColumn::make('end_day')->date(),
                TextColumn::make('quantity_planty')->suffix("      KG"),
                TextColumn::make('expected_productivity')->suffix("      KG"),
                TextColumn::make('4season')->label("Les quatre saisons"),
                TextColumn::make('productivity')->label("productivity")->suffix("     KG"),
                TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
