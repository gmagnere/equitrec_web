<?php

namespace Database\Factories;

use App\Models\TechLevels;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<TechLevels>
 */
class TechLevelsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'libelleTechLevel' =>$this->faker->realText(20)
        ];
    }
}
