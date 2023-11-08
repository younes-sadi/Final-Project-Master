<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\SensorData;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;
use App\Filament\Widgets\DataStatsOverview;
use App\Filament\Widgets\TemperatureChartApex;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SensorDataResource\Pages;
use App\Filament\Resources\SensorDataResource\RelationManagers;

class SensorDataResource extends Resource
{
    protected static ?string $model = SensorData::class;

    protected static ?string $navigationIcon = 'heroicon-o-database';
    protected static ?string $navigationGroup = 'Data';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                TextColumn::make('id')->label("ID")->sortable(),
                TextColumn::make('season.name')->label("Season ID"),
                TextColumn::make('temperature')->suffix("   °C")->sortable(),
                TextColumn::make('humidity')->suffix("   %")->sortable(),
                TextColumn::make('soil')->suffix("   %")->sortable(),
                TextColumn::make('light')->suffix("    lux")->sortable(),
                TextColumn::make('created_at')->dateTime()
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
            ->actions([

            ])
            ->bulkActions([

            ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSensorData::route('/'),

        ];
    }
}
