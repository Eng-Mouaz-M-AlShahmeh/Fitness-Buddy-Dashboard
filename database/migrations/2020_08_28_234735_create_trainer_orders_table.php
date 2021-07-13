<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('trainer_id')->unsigned()->nullable();
            $table->string('total');
            $table->string('order_number');
            $table->string('transaction_id');
            $table->tinyInteger('accepted')
                ->nullable()
                ->comment('0 =>not accepted, 1 => accepted');
            $table->tinyInteger('payment_status')
                ->nullable()
                ->comment('0 =>cash, 1 => card');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('trainer_id')->references('id')->on('trainers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainer_orders');
    }
}
