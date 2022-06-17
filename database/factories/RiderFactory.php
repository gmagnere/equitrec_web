<?php

namespace Database\Factories;

use App\Models\Championship;
use App\Models\Rider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Rider>
 */
class RiderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
            'bib_number' => $this->faker->numberBetween(),
            'id_championship' =>Championship::all()->random()->id,
        ];
    }
}
