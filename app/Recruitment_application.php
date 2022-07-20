<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruitment_application extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public function user(){
        return $this->belongsTo('App\User');
    }
}
