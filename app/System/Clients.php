<?php

namespace App\System;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    //
    protected $fillable = ['first_name','middle_name','last_name','contact','email','school','birthdate','gender','school','client_type','source_of_awareness','emp_id','center_id'];
}
