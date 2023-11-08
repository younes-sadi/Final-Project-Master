<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Plant;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PlantResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PlantResource\RelationManagers;
use App\Filament\Resources\PlantResource\RelationManagers\SeasonRelationManager;
use Illuminate\Database\Eloquent\Model;


class PlantResource extends Resource
{
    protected static ?string $model = Plant::class;
    public static function getGloballySearchableAttributes(): array
{
    return ['type', 'name'];
}
public static function getGlobalSearchResultDetails(Model $record): array
{
    return [
        'Name' => $record->name,
        'Type' => $record->type,
    ];
}
// protected static ?string $recordTitleAttribute = 'name';



    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationGroup = 'Plant';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make("name")->required()->label("Name")->nullable(false),
                    Select::make('type')->label("Type")
                    ->options([
                        'Tomato' => 'Tomato',
                        'Potato' => 'Potato',
                    ])->nullable(false),
                    TextInput::make('duree_de_plontation')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   Week")->nullable(false),
                    TextInput::make('productivity')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   KG/HA")->nullable(false),
                    TextInput::make('duree_floration')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   Week")->nullable(false),
                    TextInput::make('duree_nouaison')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   Week")->nullable(false),
                    TextInput::make('duree_debut_recolte')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   Week")->nullable(false),
                    TextInput::make('duree_fin_recorte')->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   Week")->nullable(false),


                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name'),
                TextColumn::make('type'),
                TextColumn::make('duree_de_plontation')->suffix("   Week"),
                TextColumn::make('productivity'),
                TextColumn::make('duree_floration')->suffix("   Week"),
                TextColumn::make('duree_nouaison')->suffix("   Week"),
                TextColumn::make('duree_debut_recolte')->suffix("   Week"),
                TextColumn::make('duree_fin_recorte')->suffix("   Week")
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->visible(false),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPlants::route('/'),
            'create' => Pages\CreatePlant::route('/create'),
            'edit' => Pages\EditPlant::route('/{record}/edit'),
        ];
    }
}
