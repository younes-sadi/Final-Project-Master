<?php

namespace App\Filament\Resources\SeasonResource\RelationManagers;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class DeviceRelationManager extends RelationManager
{
    protected static string $relationship = 'device';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('name')
                //     ->required()
                //     ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label("ID")->sortable(),
                BooleanColumn::make('fan')->label("FAN"),
                BooleanColumn::make('pump')->label("PUMP"),
                BooleanColumn::make('led')->label("LED"),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('fan')->label("FAN")
                ->options([
                    true => 'ON',
                    false=>'OFF'

                ]),
                SelectFilter::make('pump')->label("PUMP")
                ->options([
                    true => 'ON',
                    false=>'OFF'

                ]),
                SelectFilter::make('led')->label("LED")
                ->options([
                    true => 'ON',
                    false=>'OFF'
                ]),
                Filter::make('created_at')
                ->form([
                    Forms\Components\DatePicker::make('created_from'),
                    Forms\Components\DatePicker::make('created_until'),
                    Forms\Components\Checkbox::make('Today'),
                    Forms\Components\Checkbox::make('Last Week'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    $startOfWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfWeek = Carbon::now()->subWeek()->endOfWeek();
        $endOfWeek = $endOfWeek->addDay(1);
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        )->when(
                            $data['Today'],
                            fn (Builder $query): Builder => $query->whereDate('created_at',"=",Carbon::today()->toDateString()),
                        )->when(
                            $data['Last Week'],
                            fn (Builder $query): Builder => $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]),
                        );
                })
            ])
            ->headerActions([

            ])
            ->actions([

            ])
            ->bulkActions([

            ]);
    }
}
