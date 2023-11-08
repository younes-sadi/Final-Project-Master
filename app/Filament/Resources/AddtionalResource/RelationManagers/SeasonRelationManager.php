<?php

namespace App\Filament\Resources\AddtionalResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
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

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label("ID"),
                TextColumn::make('name')->label("Name")->sortable()->searchable(),
                TextColumn::make('plant')->label("Plant"),
                TextColumn::make('duree')->label("Duree")->suffix("    Jours"),
                TextColumn::make('4season')->label("Les quatre saisons"),
                TextColumn::make('productivity')->label("productivity")->suffix("     KG"),
                TextColumn::make('created_at')->dateTime()

            ])
            ->filters([
                //
            ])
            ->headerActions([

            ])
            ->actions([

            ])
            ->bulkActions([

            ]);
    }
}
