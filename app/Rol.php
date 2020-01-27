<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function gebruikers() {
        return $this->hasMany('App\Gebruiker');
    }
}
