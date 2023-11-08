<?php

namespace App\Models;

use App\Models\Season;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Devices extends Model
{
    use HasFactory;
    protected $fillable = ["season_id","fan","pump","led"];
    protected $casts = [
        'fan'=>'boolean',
        'pump'=>'boolean',
        'led'=>'boolean',
    ];
    public function season(){
        return $this->belongsTo(Season::class);
    }
}
