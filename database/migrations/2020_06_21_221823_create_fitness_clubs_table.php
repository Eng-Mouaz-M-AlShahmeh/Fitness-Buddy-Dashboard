<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFitnessClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fitness_clubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lat');
            $table->string('lng');
            $table->string('logo');
            $table->string('image');
            $table->boolean('status')->default(0);
            $table->boolean('type');
             $table->bigInteger('dept_id')->unsigned()->default('2');
            $table->bigInteger('city_id')->unsigned();
            $table->timestamps();
            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onDelete('cascade');
            $table->foreign('dept_id')
                ->references('id')->on('departments')
                ->onDelete('cascade');
        });
        Schema::create('fitness_club_translations', function(Blueprint $table)
        {
            $table->increments('fitness_clubs_trans_id');
            $table->bigInteger('fitness_club_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->text('desc');
            $table->text('terms');
            $table->unique(['fitness_club_id','locale']);
            $table->foreign('fitness_club_id')->references('id')->on('fitness_clubs')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fitness_clubs');
    }
}
