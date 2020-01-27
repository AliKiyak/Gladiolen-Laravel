<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    public $timestamps = false;

    public $guarded = [];

    public function verenigingen() {
        return $this->belongsToMany('App\Vereniging');
    }

    public function evenementvereniging() {
        return $this->hasMany('App\EvenementVereniging');
    }

    public function tshirttypes() {
        return $this->hasMany('App\Tshirttype');
    }
}
