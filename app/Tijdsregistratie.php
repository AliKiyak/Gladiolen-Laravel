<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tijdsregistratie extends Model
{
    public $timestamps = false;

    public function gebruiker() {
        return $this->belongsTo('App\Gebruiker');
    }
}
