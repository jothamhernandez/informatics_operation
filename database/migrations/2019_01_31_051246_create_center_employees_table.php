<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_uid')->unique();
            $table->integer('center_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->string('position')->nullable();
            $table->timestamps();

            $table->foreign('center_id')->references('id')->on('centers');
            $table->foreign('employee_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('center_employees');
    }
}
