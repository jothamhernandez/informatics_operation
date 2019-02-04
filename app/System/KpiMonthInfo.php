<?php

namespace App\System;

use Illuminate\Database\Eloquent\Model;

class KpiMonthInfo extends Model
{
    //
    protected $fillable = ['center_id','manager_id','kpi_month','he_head_count_target','he_database_target','shs_head_count_target','shs_database_target','icl_revenue_target','icl_retail_database_target','icl_corpo_database_target'];

    protected $appends = ['center_info'];

    public function getCenterInfoAttribute(){
        return $this['attribute'] = $this->belongsTo('App\System\Center','center_id')->first();
    }
}
