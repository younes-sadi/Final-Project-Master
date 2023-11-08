<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SensorData extends Model
{
    use HasFactory;

    protected $fillable = ["season_id","temperature","humidity","soil","light","commentaire"];

    public function season(){
        return $this->belongsTo(Season::class);
    }
    public function scopeAll(Builder $query)
    {
        return SensorData::all();
    }
    public function scopeToday(Builder $query)
    {
        return $query->whereDate('created_at', now()->toDateString()." 00:00:00")->get();
    }
    public function scopeLastWeek(Builder $query)
    {
        $startOfWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfWeek = Carbon::now()->subWeek()->endOfWeek();

        return $query->whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
    }
}
