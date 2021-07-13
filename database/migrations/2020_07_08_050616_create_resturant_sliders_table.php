<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResturantSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resturant_sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('resturant_id')->unsigned();
            $table->string('image');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('resturant_id')
                ->references('id')->on('resturants')
                ->onDelete('cascade');
        });
        Schema::create('resturant_slider_translations', function(Blueprint $table)
        {
            $table->increments('resturant_sliders_trans_id');
            $table->bigInteger('resturant_slider_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('title');
            $table->text('description');
            $table->unique(['resturant_slider_id','locale']);
            $table->foreign('resturant_slider_id')->references('id')->on('resturant_sliders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resturant_sliders');
    }
}
