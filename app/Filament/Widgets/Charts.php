<?php

namespace App\Filament\Widgets;

use Kenepa\MultiWidget\MultiWidget;



class Charts extends MultiWidget
{
    public static function canView(): bool
    {
        return true;
    }
    public array $widgets = [
     Temperature::class,
     Humidity::class,
     Soil::class,
     LightW::class

    ];
}
