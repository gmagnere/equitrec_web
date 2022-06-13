<?php

namespace Database\Factories;

use App\Models\ChampionshipHasTrials;
use App\Models\Trial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<ChampionshipHasTrials>
 */
class ChampionshipHasTrialsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_obstacle' => Trial::all()->random()->id,
            'id_championship' => Trial::all()->random()->id
        ];
    }
}
