<?php

namespace App\System;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    //
    protected $fillable = ['ip_address','action','user_id'];
}
