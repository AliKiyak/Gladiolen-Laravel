<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function gebruiker() {
        return $this->belongsTo('App\Gebruiker');
    }

    public function tshirttype() {
        return $this->belongsTo('App\Tshirttype');
    }

}
