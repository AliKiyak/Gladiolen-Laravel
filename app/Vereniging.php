<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vereniging extends Model
{
    public $timestamps = false;

    public $guarded = [];

    public function hoofd() {
        return $this->hasOne('App\Gebruiker', 'hoofdverantwoordelijke');
    }
    public function tweede() {
        return $this->hasOne('App\Gebruiker', 'tweedeverantwoordelijke');
    }
    public function contactpersoon() {
        return $this->hasOne('App\Gebruiker', 'contactpersoon');
    }
}
