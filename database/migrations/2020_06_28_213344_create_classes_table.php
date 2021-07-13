<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('time');
            $table->boolean('status');
            $table->timestamps();
        });
        Schema::create('class_translations', function(Blueprint $table)
        {
            $table->increments('classes_trans_id');
            $table->bigInteger('class_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->unique(['class_id','locale']);
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
