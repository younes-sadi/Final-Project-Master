<?php

namespace App\Filament\Resources\SeasonResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Season;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ExtraRelationManager extends RelationManager
{
    protected static string $relationship = 'extra';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('season_id')
                    ->label('Season Name')
                    ->options(Season::all()->pluck('name', 'id'))
                    ->searchable(),
                    TextInput::make('name')->label("Name"),
                    TextInput::make("quantity")->numeric()->mask(fn (TextInput\Mask $mask)=>$mask ->numeric(true))->suffix("   KG")->label("Quantity"),
                    Select::make('retard')->options([
                        false=>"Non",
                        true=>"Oui",
                    ])->label("Retard")






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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([

            ])
            ->bulkActions([

            ]);
    }
}
