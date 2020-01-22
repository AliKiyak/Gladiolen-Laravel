<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vereniging extends Model
{
    public $timestamps = false;

    public $guarded = [];
    public function taaks() {
        return $this->belongsToMany('App\Taak');
    }

    public function gebruikers() {
        return $this->belongsToMany('App\Gebruiker');
    }

    public function evenements() {
        return $this->belongsToMany('App\Evenement');
    }
    public function hoofd() {
        return $this->hasOne('App\Gebruiker', 'hoofdverantwoordelijke');
    }
    public function tweede() {
        return $this->hasOne('App\Gebruiker', 'tweedeverantwoordelijke');
    }
}
