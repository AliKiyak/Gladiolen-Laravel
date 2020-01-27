<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taak extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function subtaak() {
        return $this->belongsTo('App\Subtaak');
    }
    public function taakgroep() {
        return $this->belongsTo('App\Taakgroep');
    }

    public function evenementvereniging() {
        return $this->belongsToMany('App\EvenementVereniging');
    }


}
