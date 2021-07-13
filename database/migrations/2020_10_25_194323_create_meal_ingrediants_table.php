<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealIngrediantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_ingrediants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('meal_id')->unsigned();
            $table->string('calorie');
            $table->timestamps();
            $table->foreign('meal_id')
                ->references('id')->on('meals')
                ->onDelete('cascade');
        });
        Schema::create('meal_ingrediants_translations', function(Blueprint $table)
        {
            $table->increments('meal_ingrediants_trans_id');
            $table->bigInteger('meal_ingredient_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('ingredient');
            $table->string('calories');
            $table->unique(['meal_ingredient_id','locale']);
            $table->foreign('meal_ingredient_id')->references('id')->on('meal_ingrediants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_ingrediants');
    }
}
