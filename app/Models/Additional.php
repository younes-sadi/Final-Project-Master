<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    use HasFactory;
    protected $fillable = ["season_id","name","quantity","retard"];
    protected $casts = [
        'retard'=>'boolean',
    ];
    public function season(){
        return $this->belongsTo(Season::class);
    }
}
