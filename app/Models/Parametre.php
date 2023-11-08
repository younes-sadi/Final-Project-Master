<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    use HasFactory;
    protected $fillable = ["season_id","TemperatureValeur_max","TemperatureValeur_min","HumidityValeur","SoilValeur","LightValeur_max","LightValeur_min"];

    public function season(){
        return $this->belongsTo(Season::class);
    }
}
