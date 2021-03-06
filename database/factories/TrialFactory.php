<?php

namespace Database\Factories;

use App\Models\Trial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Trial>
 */
class TrialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'libelleTrial' =>$this->faker->realText(15),
        ];
    }
}
