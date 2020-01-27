<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gebruiker extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function rol(){
        return $this->belongsTo('App\Rol');
    }
    public function tshirts() {
        return $this->belongsToMany('App\Tshirt');
    }

    public function verenigingen() {
        return $this->belongsToMany('App\Vereniging');
    }
    public function tijdsregistraties() {
        return $this->hasMany('App\Tijdsregistratie');
    }

}
