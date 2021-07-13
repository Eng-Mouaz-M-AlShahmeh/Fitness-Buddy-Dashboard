<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFitnessClubOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fitness_club_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fitness_club_id')->unsigned()->nullable();
            $table->bigInteger('subscription_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('total');
            $table->string('order_number');
            $table->string('transaction_id');
            $table->string('pause_period');
            $table->tinyInteger('accepted')
                ->nullable()
                ->comment('0 =>not accepted, 1 => accepted');
            $table->tinyInteger('payment_status')
                ->nullable()
                ->comment('0 =>cash, 1 => card');
            $table->timestamps();
            $table->timestamp('ended_at')->nullable();
            $table->foreign('fitness_club_id')->references('id')->on('fitness_clubs')->onDelete('cascade');
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fitness_club_orders');
    }
}
