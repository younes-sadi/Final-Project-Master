<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParametreRequest;
use App\Http\Requests\UpdateParametreRequest;
use App\Models\Parametre;

class ParametreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parametre = Parametre::latest()->first();
        return response()->json([
        'season_id'=>$parametre->season_id,
          'TemperatureValeur' =>$parametre->TemperatureValeur_max,
          'HumidityValeur'=>$parametre->HumidityValeur,
          'SoilValeur'=>$parametre->SoilValeur,
          'LightValeur'=>$parametre->LightValeur_max
        ]);
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
    public function store(StoreParametreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Parametre $parametre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parametre $parametre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParametreRequest $request, Parametre $parametre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parametre $parametre)
    {
        //
    }
}
