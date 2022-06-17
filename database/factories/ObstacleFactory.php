<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Obstacle;
use App\Models\Pace;
use App\Models\Penalities;
use App\Models\Style;
use App\Models\Trial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Obstacle>
 */
class ObstacleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'libelleObstacle' => $this->faker->realText(15),
            'noteMax' => $this->faker->numberBetween(0, 20),
            'id_trial' => Trial::all()->random()->id,
            'id_pace' => Pace::all()->random()->id,
            'id_contract' => Contract::all()->random()->id,
            'id_penality' => Penalities::all()->random()->id,
            'id_style' => Style::all()->random()->id,
        ];
    }
}
