<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('dept_id')->unsigned()->default(4);
            $table->bigInteger('plan_id')->unsigned();
            $table->boolean('type');
            $table->bigInteger('city_id')->unsigned();
            $table->string('price');
            $table->string('image');
            $table->boolean('status');
            $table->bigInteger('nationality_id')->unsigned();
            $table->string('age');
            $table->string('lat');
            $table->string('lng');
            $table->timestamp('available_time');
            $table->tinyInteger('is_busy')->default('0')
                ->comment('0 => not busy, 1 => busy');
            $table->timestamps();
            $table->foreign('dept_id')
                ->references('id')->on('departments')
                ->onDelete('cascade');
            $table->foreign('plan_id')
                ->references('id')->on('plans')
                ->onDelete('cascade');
            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onDelete('cascade');
            $table->foreign('nationality_id')
                ->references('id')->on('nationalities')
                ->onDelete('cascade');
        });
        Schema::create('trainer_translations', function(Blueprint $table)
        {
            $table->increments('trainers_trans_id');
            $table->bigInteger('trainer_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->text('about');
            $table->string('level');
            $table->string('currency');
            $table->string('class');
            $table->text('terms');
            $table->unique(['trainer_id','locale']);
            $table->foreign('trainer_id')->references('id')->on('trainers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainers');
    }
}
