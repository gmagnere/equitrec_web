<?php

namespace Database\Factories;

use App\Models\Penalities;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Penalities>
 */
class PenalitiesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'libellePenalty' => $this->faker->realText(25),
            'penalty' => $this->faker->numberBetween(-10, -10),
        ];
    }
}
