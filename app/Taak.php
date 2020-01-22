<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taak extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function verenigings() {
        return $this->belongsToMany('App\Vereniging');
    }
}
