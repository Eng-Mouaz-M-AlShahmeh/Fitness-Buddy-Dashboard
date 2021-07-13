<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('branch_id')->unsigned();
            $table->bigInteger('resturant_id')->unsigned();
            $table->bigInteger('cat_id')->unsigned();
            $table->bigInteger('meal_day_id')->unsigned()->nullable();
            $table->bigInteger('day_id')->unsigned()->nullable();
            $table->bigInteger('plan_id')->unsigned()->nullable();
            $table->boolean('status')->default(1);
            $table->string('image');
            $table->string('calories');
            $table->string('price_before');
            $table->string('price_after');
            $table->timestamps();
            $table->foreign('resturant_id')
                ->references('id')->on('resturants')
                ->onDelete('cascade');
            $table->foreign('branch_id')
                ->references('id')->on('branches')
                ->onDelete('cascade');
            $table->foreign('cat_id')
                ->references('id')->on('resturant_categories')
                ->onDelete('cascade');
            $table->foreign('meal_day_id')
                ->references('id')->on('meal_day')
                ->onDelete('cascade');
            $table->foreign('day_id')
                ->references('id')->on('days')
                ->onDelete('cascade');
            $table->foreign('plan_id')
                ->references('id')->on('plans')
                ->onDelete('cascade');
        });
        Schema::create('meal_translations', function(Blueprint $table)
        {
            $table->increments('meals_trans_id');
            $table->bigInteger('meal_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->string('currency');
            $table->string('calorie');
            $table->text('desc');
            $table->unique(['meal_id','locale']);
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals');
    }
}
