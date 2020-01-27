<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tijdsregistratie extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function gebruiker() {
        return $this->belongsTo('App\Gebruiker');
    }

    public function evenementvereniging() {
        return $this->belongsTo('App\EvenementVereniging');
    }

}
