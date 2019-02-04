<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKpiMonthInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi_month_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('center_id')->unsigned();
            $table->integer('manager_id')->unsigned();
            $table->date('kpi_month');
            $table->integer('he_head_count_target')->nullable();
            $table->integer('he_database_target')->nullable();
            $table->integer('shs_head_count_target')->nullable();
            $table->integer('shs_database_target')->nullable();
            $table->double('icl_revenue_target', 10, 2)->nullable();
            $table->integer('icl_retail_database_target')->nullable();
            $table->integer('icl_corpo_database_target')->nullable();
            $table->timestamps();

            $table->foreign('center_id')->references('id')->on('centers');
            $table->foreign('manager_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kpi_month_infos');
    }
}
