<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gebruiker extends Model
{
    public $timestamps = false;
    public $guarded = [];
    public function tijdsregistraties() {
        return $this->hasMany('App\Tijdsregistratie');
    }
    public function tshirt() {
        return $this->belongsTo('App\Tshirt');
    }
    public function rol() {
        return $this->belongsTo('App\Rol');
    }
    public function verenigings() {
        return $this->belongsToMany('App\Vereniging');
    }


}
