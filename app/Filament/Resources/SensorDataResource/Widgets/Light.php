<?php

namespace App\Filament\Resources\SensorDataResource\Widgets;

use Carbon\Carbon;
use App\Models\Season;
use App\Models\SensorData;
use Filament\Forms\Components\DatePicker;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class Light extends ApexChartWidget
{
    protected static string $chartId = 'lightChart';
    protected static ?string $heading = 'Light Chart';
    protected static bool $darkMode = true;
    protected static ?int $contentHeight = 500; //px
    protected static ?int $contentWeight = 600; //px
    public static function canView(): bool
    {
        return false;
    }
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
    if($dateStart !== null){
        $datest = Carbon::createFromFormat('Y-m-d H:i:s', $dateStart);
        $datest = $datest->toDateString();
    }
    if($dateEnd !== null){
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
            'weight' => 600,
        ],
        'series' => [
            [
                'name' => 'Light Chart',
                'data' => $data->map(fn ($value) => $value->light)
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
        'colors' => ['#ffb10a'],
        'stroke' => [
            'curve' => 'smooth',
        ],
    ];
}




}
