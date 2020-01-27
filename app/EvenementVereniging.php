<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvenementVereniging extends Model
{
    //
    protected $guarded = [];

    public function taak() {
        return $this->belongsToMany('App\Taak');
    }

    public function evenement() {
        return $this->belongsTo('App\Evenement');
    }
    public function tijdsregistraties() {
        return $this->hasMany('App\Tijdsregistratie');
    }
}
