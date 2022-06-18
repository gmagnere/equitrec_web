<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{

    protected  $fillable = ['name', 'surname', 'bib_number', 'id_championship'];
    use HasFactory;

    public function championShipFromRider () {
        return $this->belongsTo(Championship::class, 'id_championship');
    }
}
