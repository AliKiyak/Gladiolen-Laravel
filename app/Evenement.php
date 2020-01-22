<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    public $timestamps = false;

    public function verenigings() {
        return $this->belongsToMany('App\Vereniging');
    }
}
