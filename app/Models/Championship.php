<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Championship extends Model
{
    protected $fillable = ['name', 'place', 'dateStart', 'dateEnd'];

    use HasFactory;
}
