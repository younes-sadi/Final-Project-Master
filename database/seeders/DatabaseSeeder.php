<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Parametre;
use App\Models\User;
use App\Models\Plant;
use App\Models\Season;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'farmer',
            'email'=>'f@f.com',
            'password'=>'$2y$10$2m4TIR6PT.pIVPtiIog4TuNRQnKDm376rDRofZkfqTvyvtYcSuHd.'
        ]);
        Plant::create([
            'name'=>'Tomato',
            'type'=>'Tomato',
            'duree_de_plontation'=>10,
            'productivity'=>100,
            'duree_floration'=>4,
            'duree_nouaison'=>2,
            'duree_debut_recolte'=>2,
            'duree_fin_recorte'=>2
        ]);

    }
}
