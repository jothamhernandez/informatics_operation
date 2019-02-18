<?php

namespace App\System;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $fillable = ['user_id','subject','description'];

    protected $appends = ['user_details'];

    public function getUserDetailsAttribute(){
        return $this->belongsTo('App\User','user_id')->first();
    }
}
