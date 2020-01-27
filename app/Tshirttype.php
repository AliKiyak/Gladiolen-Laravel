<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tshirttype extends Model
{
    //
    protected $guarded = [];

    public function tshirt() {
        return $this->hasMany('App\Tshirt');
    }

    public function evenement() {
        return $this->belongsTo('App\Evenement');
    }
}
