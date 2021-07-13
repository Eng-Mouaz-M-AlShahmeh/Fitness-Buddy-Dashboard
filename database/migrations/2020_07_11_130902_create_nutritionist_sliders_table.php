<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNutritionistSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutritionist_sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nutritionist_id')->unsigned();
            $table->string('image');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('nutritionist_id')
                ->references('id')->on('nutritionist')
                ->onDelete('cascade');
        });
        Schema::create('nutritionist_slider_trans', function(Blueprint $table)
        {
            $table->increments('nutritionist_slides_trans_id');
            $table->bigInteger('nutritionist_slider_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('title');
            $table->text('description');
            $table->unique(['nutritionist_slider_id','locale']);
            $table->foreign('nutritionist_slider_id')->references('id')->on('nutritionist_sliders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nutritionist_sliders');
    }
}
