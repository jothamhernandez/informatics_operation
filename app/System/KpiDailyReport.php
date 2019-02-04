<?php

namespace App\System;

use Illuminate\Database\Eloquent\Model;

class KpiDailyReport extends Model
{
    //
    protected $fillable = ['center_id','prepared_by','kpi_month','he_head_count_actual','he_database_actual','shs_head_count_actual','shs_database_actual','icl_revenue_actual','icl_retail_database_actual','icl_corpo_database_actual'];

}
