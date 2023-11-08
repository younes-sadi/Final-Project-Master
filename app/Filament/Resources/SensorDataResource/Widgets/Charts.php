<?php

namespace App\Filament\Resources\SensorDataResource\Widgets;


use Kenepa\MultiWidget\MultiWidget;



class Charts extends MultiWidget
{
    public array $widgets = [
     TemperatureChart::class,
     HumidityChart::class,
     SoilChart::class,
     Light::class,
    ];
}
