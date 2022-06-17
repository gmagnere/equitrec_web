<?php

namespace Database\Factories;

use App\Models\Evaluate;
use App\Models\Obstacle;
use App\Models\Rider;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Evaluate>
 */
class EvaluateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'hours'=> $this->faker->dateTime,
            'id_obstacle' => Obstacle::all()->random()->id,
            'id_user' => User::all()->random()->id,
            'id_rider' => Rider::all()->random()->id,
        ];
    }
}
