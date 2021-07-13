<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderResturantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_resturants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('resturant_id')->unsigned()->nullable();
            $table->string('total');
            $table->string('order_number');
            $table->string('transaction_id');
            $table->tinyInteger('payment_status')
                ->nullable()
                ->comment('0 =>cash, 1 => card');
            $table->tinyInteger('status')->default('0')
                ->comment('0 => in processing, 1 => in delivery 2=> delivered, -1 => cancelled');
            $table->tinyInteger('accepted')
                ->nullable()
                ->comment('0 =>not accepted, 1 => accepted');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('resturant_id')->references('id')->on('resturants')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_resturants');
    }
}
