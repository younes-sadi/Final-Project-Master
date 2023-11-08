<?php

namespace App\Filament\Widgets;

use Kenepa\MultiWidget\MultiWidget;



class ChartsStats extends MultiWidget
{
    public static function canView(): bool
    {
        return true;
    }
    public array $widgets = [
       ParametreTested::class,
       SeasonTable::class,
       DataStatsOverview::class,

    ];
}
