<?php

namespace Database\Factories;

use App\Models\HasTechLevel;
use App\Models\Obstacle;
use App\Models\TechLevels;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<HasTechLevel>
 */
class HasTechLevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_tech_level' => TechLevels::all()->random()->id,
            'id_obstacle' => Obstacle::all()->random()->id,
        ];
    }
}
