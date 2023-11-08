<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;
    protected $fillable = ["season_id","duree_floration","duree_nouaison","duree_debut_recolte","duree_fin_recorte"];
    public function season(){
        return $this->belongsTo(Season::class);
    }
}
