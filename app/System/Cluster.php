<?php

namespace App\System;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    //
    protected $fillable = ['cluster_head_id','cluster_name'];

    protected $appends = ['cluster_head_details'];

    protected function getClusterHeadDetailsAttribute(){
        return $this['attributes'] = $this->belongsTo('App\User', 'cluster_head_id')->first();
    }
}
