<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWapDiscussionPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wap_discussion_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("wap_id")->unsigned();
            $table->string('discussion_point');
            $table->text('updates');
            $table->text('academics');
            $table->text('business');
            $table->text('corporate');
            $table->timestamps();

            $table->foreign('wap_id')->references('id')->on('wap_records');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wap_discussion_points');
    }
}
