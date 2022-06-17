<?php

namespace Database\Factories;

use App\Models\Grade;
use App\Models\GradeHasLevel;
use App\Models\TechLevels;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<GradeHasLevel>
 */
class GradeHasLevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_grade' => Grade::all()->random()->id,
            'id_tech_level' => TechLevels::all()->random()->id,
        ];
    }
}
