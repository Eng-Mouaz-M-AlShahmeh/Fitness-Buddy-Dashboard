<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainerVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('trainer_id')->unsigned();
            $table->string('video');
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('trainer_id')
                ->references('id')->on('trainers')
                ->onDelete('cascade');
        });
        Schema::create('trainer_videos_translations', function(Blueprint $table)
        {
            $table->increments('trainer_videos_trans_id');
            $table->bigInteger('trainer_video_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->unique(['trainer_video_id','locale']);
            $table->foreign('trainer_video_id')->references('id')->on('trainer_videos')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainer_videos');
    }
}
