<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNutriotionistLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutritionist_languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nutritionist_id')->unsigned();
            $table->bigInteger('language_id')->unsigned();
            $table->timestamps();
            $table->foreign('nutritionist_id')
                ->references('id')->on('nutritionist')
                ->onDelete('cascade');
            $table->foreign('language_id')
                ->references('id')->on('languages')
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
        Schema::dropIfExists('nutriotionist_languages');
    }
}
