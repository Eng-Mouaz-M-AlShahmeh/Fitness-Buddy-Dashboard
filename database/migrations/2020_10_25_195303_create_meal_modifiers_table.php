<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealModifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_modifiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('meal_id')->unsigned();
            $table->bigInteger('modifier_id')->unsigned();
            $table->timestamps();
            $table->foreign('meal_id')
                ->references('id')->on('meals')
                ->onDelete('cascade');
            $table->foreign('modifier_id')
                ->references('id')->on('modifiers')
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
        Schema::dropIfExists('meal_modifiers');
    }
}
