<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vereniging extends Model
{
    public $timestamps = false;

    public $guarded = [];

    public function hoofd() {
        return $this->belongsTo('App\Gebruiker', 'hoofdverantwoordelijke');
    }
    public function tweede() {
        return $this->belongsTo('App\Gebruiker', 'tweedeverantwoordelijke');
    }
    public function contact() {
        return $this->belongsTo('App\Gebruiker', 'contactpersoon');
    }

    public function gebruikers() {
        return $this->belongsToMany('App\Gebruiker');
    }

    public function evenementen() {
        return $this->belongsToMany('App\Evenement');
    }
    public function tijdsregistraties()
    {
        return $this->hasMany('App\Tijdsregistratie');
    }
}
