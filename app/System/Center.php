<?php

namespace App\System;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    //

    protected $fillable = ['cluster_id','center_manager','center_name'];

    protected $appends = ['center_manager_details', 'cluster_details'];

    public function getCenterManagerDetailsAttribute(){
        return $this['attributes'] = $this->belongsTo('App\User','center_manager')->first();
    }

    public function getClusterDetailsAttribute(){
        return $this['attributes'] = $this->belongsTo('App\System\Cluster', 'cluster_id')->first();
    }

    public function employees(){
        return $this->belongsToMany('App\User', 'center_employees','center_id','employee_id');
    }

    public function centerKpi(){
        return $this->hasMany('App\System\KpiDailyReport');
    }
    
    public function centerKpiTarget(){
        return $this->hasMany('App\System\KpiMonthInfo');
    }
}
