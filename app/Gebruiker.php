<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticable;
class Gebruiker extends Authenticable
{
    use HasApiTokens,Notifiable;
    public $timestamps = false;
    public $guarded = [];

    public function rol(){
        return $this->belongsTo('App\Rol');
    }
    public function tshirts() {
        return $this->hasMany('App\Tshirt');
    }

    public function verenigingen() {
        return $this->belongsToMany('App\Vereniging');
    }
    public function tijdsregistraties() {
        return $this->hasMany('App\Tijdsregistratie');
    }


}
