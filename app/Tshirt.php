<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function gebruikers() {
        return $this->belongsToMany('App\Gebruiker');
    }

    public function tshirttype() {
        return $this->belongsTo('App\Tshirttype');
    }

}
