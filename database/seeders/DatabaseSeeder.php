<?php

namespace Database\Seeders;

use App\Models\Championship;
use App\Models\ChampionshipHasTrials;
use App\Models\Contract;
use App\Models\Evaluate;
use App\Models\Grade;
use App\Models\GradeHasLevel;
use App\Models\HasTechLevel;
use App\Models\Horse;
use App\Models\Obstacle;
use App\Models\Pace;
use App\Models\Penalities;
use App\Models\Rider;
use App\Models\Role;
use App\Models\TechLevels;
use App\Models\Trial;
use App\Models\User;
use App\Models\Style;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Championship::factory(5)->create();
        Grade::factory(4)->create();
        Role::factory(2)->create();
        Pace::factory(3)->create();
        Contract::factory(4)->create();
        Penalities::factory(10)->create();
        Trial::factory(3)->create();
        Style::factory(4)->create();
        TechLevels::factory(4)->create();
        Rider::factory(10)->create();
        Horse::factory(10)->create();
        User::factory(10)->create();
        GradeHasLevel::factory(4)->create();
        ChampionshipHasTrials::factory(5)->create();
        Obstacle::factory(10)->create();
        Evaluate::factory(10)->create();
        HasTechLevel::factory(10)->create();

    }
}
