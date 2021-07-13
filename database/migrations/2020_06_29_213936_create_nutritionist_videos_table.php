<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNutritionistVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutritionist_videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nutritionist_id')->unsigned();
            $table->string('video');
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('nutritionist_id')
                ->references('id')->on('nutritionist')
                ->onDelete('cascade');
        });
        Schema::create('nutritionist_videos_trans', function(Blueprint $table)
        {
            $table->increments('nutritionist_videos_trans_id');
            $table->bigInteger('nutritionist_video_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->unique(['nutritionist_video_id','locale']);
            $table->foreign('nutritionist_video_id')->references('id')->on('nutritionist_videos')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nutriotionist_videos');
    }
}
