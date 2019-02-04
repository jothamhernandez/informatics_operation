<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKpiDailyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi_daily_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('center_id')->unsigned();
            $table->integer('prepared_by')->unsigned();
            $table->integer('he_head_count_actual')->nullable();
            $table->integer('he_database_actual')->nullable();
            $table->integer('shs_head_count_actual')->nullable();
            $table->integer('shs_database_actual')->nullable();
            $table->double('icl_revenue_actual', 10, 2)->nullable();
            $table->integer('icl_retail_database_actual')->nullable();
            $table->integer('icl_corpo_database_actual')->nullable();
            $table->timestamps();

            $table->foreign('center_id')->references('id')->on('centers');
            $table->foreign('prepared_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kpi_daily_reports');
    }
}
