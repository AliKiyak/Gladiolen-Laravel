<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taakgroep extends Model
{
    //
    protected $guarded = [];

    public function taak() {
        return $this->hasMany('App\Taak');
    }
}
