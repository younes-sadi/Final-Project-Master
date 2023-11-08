<?php

namespace App\Filament\Resources\SeasonResource\RelationManagers;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class SensordataRelationManager extends RelationManager
{
    protected static string $relationship = 'sensordata';

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
                TextColumn::make('id')->label("ID")->sortable(),
                TextColumn::make('temperature')->suffix("   °C")->sortable(),
                TextColumn::make('humidity')->suffix("   %")->sortable(),
                TextColumn::make('soil')->suffix("   %")->sortable(),
                TextColumn::make('light')->suffix("    lux")->sortable()
            ])
            ->filters([
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
