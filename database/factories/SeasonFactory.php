<?php

namespace Database\Factories;

use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Season>
 */
class SeasonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Season::class;
    public function definition(): array
    {
        return [

            'name'=>'Season 1',
            'plant'=>'tomato',
            'duree'=>40,
            '4season'=>'hiver',


        ];
    }
}
