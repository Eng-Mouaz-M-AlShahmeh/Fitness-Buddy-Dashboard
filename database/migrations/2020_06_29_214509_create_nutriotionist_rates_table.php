<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNutriotionistRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutriotionist_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nutritionist_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->double('rate');
            $table->timestamps();
            $table->foreign('nutritionist_id')
                ->references('id')->on('nutritionist')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nutriotionist_rates');
    }
}
