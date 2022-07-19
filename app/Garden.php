<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Garden extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function busking_schedule(){
        return $this->hasMany('App\Busking_schedule');
    }
}
