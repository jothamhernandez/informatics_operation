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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->date('birthdate');
            $table->enum('gender', ['male','female'])->defaut('male');
            $table->string('school')->nullable();

            $table->string('contact')->nullable();
            $table->string('email')->nullable();

            $table->enum('client_type',['walk-in','sales-call']);
            $table->enum('source_of_awareness',['Telemarketing/Text Blast','Career Talks','Social Media','Website/Email','Collaterals','Referrals','Trimedia','Others']);
            $table->timestamps();

            $table->foreign('center_id')->references('id')->on('centers');
            $table->foreign('emp_id')->references('id')->on('users');

            $table->unique(['first_name','last_name','birthdate','gender']);
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
