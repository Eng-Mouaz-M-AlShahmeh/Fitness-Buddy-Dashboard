<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club_sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('club_id')->unsigned();
            $table->string('image');
            $table->tinyInteger('status')->default('1')
                ->comment('0 => inactive, 1 => active');
            $table->tinyInteger('main_slider')->default('0');
            $table->timestamps();
            $table->foreign('club_id')
                ->references('id')->on('fitness_clubs')
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
        Schema::dropIfExists('club_sliders');
    }
}
