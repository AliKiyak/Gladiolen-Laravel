<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtaak extends Model
{
    //
    protected $guarded = [];
    public function taak() {
        return $this->hasMany('App\Taak');
    }
}
