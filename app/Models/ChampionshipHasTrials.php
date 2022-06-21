<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChampionshipHasTrials extends Model
{
    protected $fillable = ['id_trial', 'id_championship'];

    use HasFactory;
}
