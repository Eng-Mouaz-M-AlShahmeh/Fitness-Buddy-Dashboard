<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealDayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_day', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('price');
            $table->timestamps();
        });
        Schema::create('meal_day_trans', function(Blueprint $table)
        {
            $table->increments('meal_day_trans_id');
            $table->bigInteger('meal_day_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->string('currency');
            $table->unique(['meal_day_id','locale']);
            $table->foreign('meal_day_id')->references('id')->on('meal_day')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_day');
    }
}
