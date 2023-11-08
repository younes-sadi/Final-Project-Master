<?php

namespace App\Filament\Widgets;

use App\Models\Season;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class SeasonTable extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return Season::query()->latest();
    }
    public static function canView(): bool
    {
        return false;
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->label("ID"),
            TextColumn::make('name')->label("Name"),
            TextColumn::make('plant.name')->label('Plant Name'),
            TextColumn::make('start_day')->date(),
            TextColumn::make('end_day')->date(),
            TextColumn::make('quantity_planty')->suffix("      KG"),
            TextColumn::make('expected_productivity')->suffix("      KG"),
            TextColumn::make('4season')->label("Les quatre saisons"),
            TextColumn::make('productivity')->label("productivity")->suffix("     KG"),
            TextColumn::make('created_at')->dateTime()
        ];
    }
}
