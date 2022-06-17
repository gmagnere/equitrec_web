<?php

namespace Database\Factories;

use App\Models\Pace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Pace>
 */
class PaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'mark' => $this->faker->numberBetween(-2, 3),
            'libellePace' => $this->faker->realText(15),
        ];
    }
}
