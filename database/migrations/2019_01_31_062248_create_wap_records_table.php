<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWapRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wap_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('center_id')->unsigned();
            $table->integer('facilitator')->unsigned();
            $table->date('date_handled');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->text('attendees')->nullable();
            $table->text('absent')->nullable();

            $table->timestamps();

            $table->foreign('center_id')->references('id')->on('centers');
            $table->foreign('facilitator')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wap_records');
    }
}
