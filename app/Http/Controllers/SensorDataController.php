<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Season;
use App\Models\Parametre;
use App\Models\SensorData;
use Illuminate\Http\Request;
use Filament\Notifications\Notification;
use App\Http\Requests\UpdateSensorDataRequest;

class SensorDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new SensorData;

        $data->season_id = $request->season_id;
        $data->humidity = $request->humidity;
        $data->temperature = $request->temperature;
        $data->soil = $request->soil;
        $data->light = $request->light;


        $parametre = Parametre::latest()->first();
        $lastdata = SensorData::latest()->first();


// if((float)$data["humidity"] != (float) $humidity ){


      if($lastdata != null && $parametre != null){
        if($request->humidity != $lastdata['humidity'] && $request->humidity>$parametre['HumidityValeur']){
            Notification::make()
            ->title('Hot Humidty Detected')
            // ->icon('heroicon-o-sun')
            ->body("Humidity is {$request->humidity} %")
            ->sendToDatabase(User::all());
        }

        if($request->temperature != $lastdata['temperature'] &&$request->temperature>$parametre['TemperatureValeur_max']){
            Notification::make()
            ->title('Hot Temperature Detected')
            // ->icon('heroicon-o-sun')
            ->body("Temperature is {$request->temperature} °C")
            ->sendToDatabase(User::all());
        }
        if($request->temperature != $lastdata['temperature'] &&$request->temperature<$parametre['TemperatureValeur_min']){
            Notification::make()
            ->title('Low Temperature Detected')
            // ->icon('heroicon-o-sun')
            ->body("Temperature is {$request->temperature} °C")
            ->sendToDatabase(User::all());
        }

        if($request->soil != $lastdata['soil'] && $request->soil<$parametre['SoilValeur']){
              Notification::make()
            ->title('Dry Soil Detected')
            // ->icon('heroicon-o-sun')
            ->body("Soil is {$request->soil} %")
            ->sendToDatabase(User::all());

        }if($request->light != $lastdata['light'] && $request->light<$parametre['LightValeur_min']){
              Notification::make()
            ->title('Low Light Detected')
            // ->icon('heroicon-o-sun')
            ->body("Light is {$request->light} Lux")
            ->sendToDatabase(User::all());

        }
        if($request->light != $lastdata['light'] && $request->light>$parametre['LightValeur_max']){
            Notification::make()
          ->title('High Light Detected')
          // ->icon('heroicon-o-sun')
          ->body("Light is {$request->light} Lux")
          ->sendToDatabase(User::all());

      }


      }
        $data->save();


        return response()->json([
            'data' => $data,
            'message' => 'Plant record created successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(SensorData $sensorData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SensorData $sensorData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSensorDataRequest $request, SensorData $sensorData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SensorData $sensorData)
    {
        //
    }
}
