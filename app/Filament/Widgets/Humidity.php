<?php

namespace App\Filament\Widgets;

use App\Models\Season;
use App\Models\SensorData;
use Filament\Widgets\LineChartWidget;

class Humidity extends LineChartWidget
{
    protected static ?string $heading = 'Humidity Chart';
    protected static ?string $pollingInterval = '5s';
    public static function canView(): bool
    {
        return false;
    }
    protected function getHeading(): string
    {
        return 'Humidity Chart';
    }
    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    protected function getData(): array
    {
        $season_id = Season::latest()->first();
        // $data = SensorData::orderBy('created_at','ASC')->get();
        if($season_id == null){
            $data = collect();
        }else{
             $data = $season_id->sensordata()->orderBy('created_at','ASC')->get();
        }
        return [
            'datasets' => [
                [
                    'label' => 'Humidity',

                    'data' => $data->map(fn ($value) => $value->humidity),
                    'borderColor'=> '#75990B',
                    'backgroundColor'=> '#990E0B',


                ],
            ],
            'labels' => $data->map(fn ($value) => \Carbon\Carbon::parse($value->created_at)->format('M d, Y')),
        ];
    }
}
