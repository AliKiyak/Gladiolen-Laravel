<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    public $timestamps = false;

    public function gebruikers() {
        return $this->hasMany('App\Gebruiker');
    }
}
