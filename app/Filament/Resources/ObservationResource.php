<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Season;
use App\Models\Observation;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ObservationResource\Pages;
use App\Filament\Resources\ObservationResource\RelationManagers;

class ObservationResource extends Resource
{
    protected static ?string $model = Observation::class;

    protected static ?string $navigationIcon = 'heroicon-o-eye';
    protected static ?string $navigationGroup = 'Observation';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('season_id')
                    ->label('Season Name')
                    ->options(Season::all()->pluck('name', 'id'))
                    ->searchable()->unique()->visibleOn('create'),
                    TextInput::make('duree_floration')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   Week"),
                    TextInput::make('duree_nouaison')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   Week"),
                    TextInput::make('duree_debut_recolte')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   Week"),
                    TextInput::make('duree_fin_recorte')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   Week"),
                ])

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
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObservations::route('/'),
            // 'create' => Pages\CreateObservation::route('/create'),
            'edit' => Pages\EditObservation::route('/{record}/edit'),
        ];
    }
}
