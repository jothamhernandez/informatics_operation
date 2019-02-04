<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('center_id')->unsigned();
            $table->integer('emp_id')->unsigned();
            $table->string('client_name');
            $table->enum('client_type',['walk-in','sales-call']);
            $table->enum('source_of_awareness',['Telemarketing/Text Blast','Career Talks','Social Media','Website/Email','Collaterals','Referrals','Trimedia','Others']);
            $table->timestamps();

            $table->foreign('center_id')->references('id')->on('centers');
            $table->foreign('emp_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
