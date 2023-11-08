<?php

namespace App\Filament\Resources\SensorDataResource\Widgets;

use App\Models\Season;
use Carbon\Carbon;
use App\Models\SensorData;
use Filament\Tables\Columns\ColorColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\SelectFilter;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class TemperatureChart extends ApexChartWidget
{
    protected static string $chartId = 'temperatureChart';
    protected static ?string $heading = 'Temperature Chart';
    protected static ?int $contentHeight = 500; //px
    protected static ?int $contentWeight = 600; //px

    public static function canView(): bool
    {
        return false;
    }
    // protected static ?string $pollingInterval = '5s';
    protected static bool $darkMode = true;
    protected function getFormSchema(): array
{
    return [
        DatePicker::make('date_start'),
        DatePicker::make('date_end')
    ];
}

protected static bool $deferLoading = true;
protected function getOptions(): array
{
    if (!$this->readyToLoad) {
        return [];
    }

    //slow query
    sleep(2);
    $dateStart = $this->filterFormData['date_start'];
    $dateEnd = $this->filterFormData['date_end'];
    $datest = '';
    $dateen = '';
    if($dateStart != null){
        $datest = Carbon::createFromFormat('Y-m-d H:i:s', $dateStart);
        $datest = $datest->toDateString();
    }
    if($dateEnd != null){
        $dateen = Carbon::createFromFormat('Y-m-d H:i:s', $dateEnd);
        $dateen = $dateen->addDay(1);
        $dateen = $dateen->toDateString();
    }
    $query = Season::latest()->first();

    if($query == null){
        $data = collect();
    }else{
        $query = $query->sensordata();
        if ($dateStart !== null && $dateEnd !== null) {
            $query->whereBetween('created_at', [$datest, $dateen]);
        } elseif ($dateStart !== null) {
            $query->whereDate('created_at', '>=', $datest);
        } elseif ($dateEnd !== null) {
            $query->whereDate('created_at', '<', $dateen);
        }

 $data = $query->orderBy('created_at','ASC')->get();
    }








    return [
        'theme' => [
            'mode' => 'dark' //dark
        ],
        'chart' => [
            'type' => 'line',
            'height' => 500,
            'weight'=>500,
        ],
        'series' => [
            [
                'name' => 'Temperature Chart',
                'data' => $data->map(fn ($value) => number_format($value->temperature,2))
            ],
        ],
        'xaxis' => [
            'categories' => $data->map(fn ($value) => \Carbon\Carbon::parse($value->created_at)->format('M d, Y')),
            'labels' => [
                'style' => [
                    'colors' => '#9ca3af',
                    'fontWeight' => 600,
                ],
            ],
        ],
        'yaxis' => [
            'labels' => [
                'style' => [
                    'colors' => '#9ca3af',
                    'fontWeight' => 600,
                ],
            ],
        ],
        'colors' => ['#36A2EB'],
        'stroke' => [
            'curve' => 'smooth',
        ],
    ];
}


}
