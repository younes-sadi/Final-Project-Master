<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Season;
use App\Models\Additional;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AdditionalResource\Pages;
use App\Filament\Resources\AdditionalResource\RelationManagers;
use App\Filament\Resources\AddtionalResource\RelationManagers\SeasonRelationManager;

class AdditionalResource extends Resource
{
    protected static ?string $model = Additional::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Additional';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('season_id')
                    ->label('Season Name')
                    ->options(Season::all()->pluck('name', 'id'))
                    ->searchable()->nullable(false),
                    TextInput::make('name')->label("Name")->nullable(false),
                    TextInput::make("quantity")->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   KG")->label("Quantity")->nullable(false),
                    Select::make('retard')->options([
                        false=>"Non",
                        true=>"Oui",
                    ])->label("Retard")->nullable(false)






                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label("ID")->sortable(),
                TextColumn::make('season_id')->label("Season Name"),
                TextColumn::make("name"),
                TextColumn::make('quantity')->suffix("    KG"),
                BooleanColumn::make('retard')->label("Retard")

            ])
            ->filters([

                SelectFilter::make('retard')->label("Retard")
                ->options([
                   false=>'Non',
                   true=>'Oui',
                ])
            ])
            ->actions([

            ])
            ->bulkActions([

            ]);
    }

    public static function getRelations(): array
    {
        return [
            SeasonRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdditionals::route('/'),
            'create' => Pages\CreateAdditional::route('/create'),
            'edit' => Pages\EditAdditional::route('/{record}/edit'),
        ];
    }
}
