<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainerSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('trainer_id')->unsigned();
            $table->string('image');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('trainer_id')
                ->references('id')->on('trainers')
                ->onDelete('cascade');
        });
        Schema::create('trainer_slider_translations', function(Blueprint $table)
        {
            $table->increments('trainer_sliders_trans_id');
            $table->bigInteger('trainer_slider_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('title');
            $table->text('description');
            $table->unique(['trainer_slider_id','locale']);
            $table->foreign('trainer_slider_id')->references('id')->on('trainer_sliders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainer_sliders');
    }
}
