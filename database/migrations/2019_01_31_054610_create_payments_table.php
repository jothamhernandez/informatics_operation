<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->enum('payment_type',['Tuition','Registration','Miscellaneous','Others']);
            $table->double('payment_value', 10, 8);
            $table->enum('payment_status',['pending','paid','locked']);
            $table->text('remarks');
            $table->boolean('revised')->default(0);
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::dropIfExists('payments');
    }
}
