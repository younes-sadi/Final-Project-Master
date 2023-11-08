<?php

namespace App\Filament\Resources\SeasonResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ObservationRelationManager extends RelationManager
{
    protected static string $relationship = 'observation';

    protected static ?string $recordTitleAttribute = 'season_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('duree_floration')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   Week"),
                TextInput::make('duree_nouaison')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   Week"),
                TextInput::make('duree_debut_recolte')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   Week"),
                TextInput::make('duree_fin_recorte')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   Week"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label("ID")->sortable(),
                TextColumn::make('season.name')->label("Season Name"),
                TextColumn::make('duree_floration')->suffix("   Week"),
                TextColumn::make('duree_nouaison')->suffix("   Week"),
                TextColumn::make('duree_debut_recolte')->suffix("   Week"),
                TextColumn::make('duree_fin_recorte')->suffix("   Week")
            ])
            ->filters([
                //
            ])
            ->headerActions([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),

            ])
            ->bulkActions([

            ]);
    }
}
