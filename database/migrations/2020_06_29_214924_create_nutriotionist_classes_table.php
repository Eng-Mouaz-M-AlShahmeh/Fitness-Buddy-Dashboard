<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNutriotionistClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutritionist_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nutritionist_id')->unsigned();
            $table->bigInteger('class_id')->unsigned();
            $table->timestamps();
            $table->foreign('nutritionist_id')
                ->references('id')->on('nutritionist')
                ->onDelete('cascade');
            $table->foreign('class_id')
                ->references('id')->on('classes')
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
        Schema::dropIfExists('nutriotionist_classes');
    }
}
