<?php

namespace App\Filament\Widgets;

use App\Models\Devices;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class DevicesStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '5s';
    public static function canView(): bool
    {
        return false;
    }

    protected function getCards(): array
    {
    $data = Devices::latest()->first();
    if($data == null){
        $fanstatus = "OFF";
        $pumpstatus = "OFF";
        $ledstatus = "OFF";
    }else{
    if($data->fan == 0 ){
      $fanstatus = "OFF";
    }else{
        $fanstatus = "ON";
    }
    if($data->pump == 0 ){
        $pumpstatus = "OFF";
      }else{
          $pumpstatus = "ON";
      }
      if($data->led == 0 ){
        $ledstatus = "OFF";
      }else{
          $ledstatus = "ON";
      }}
        return [
            Card::make('FAN',$fanstatus),
            Card::make('PUMP',$pumpstatus),
            Card::make('LED',$ledstatus),
        ];
    }
}
