<?php

namespace App\System;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $fillable = ['user_id','subject','description'];
    
}
