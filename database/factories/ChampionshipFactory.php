<?php

namespace Database\Factories;

use App\Models\Championship;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Championship>
 */
class ChampionshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realText,
            'place' => $this->faker->city,
            'dateStart' => $this->faker->dateTime('now'),
            'dateEnd' => $this->faker->dateTime('-10 days')
        ];
    }
}
