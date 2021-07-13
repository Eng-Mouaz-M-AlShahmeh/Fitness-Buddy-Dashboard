<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('status')
                ->default('1')
                ->comment('0 => inactive, 1 => active');
            $table->timestamps();
        });
        Schema::create('day_translations', function(Blueprint $table)
        {
            $table->increments('days_trans_id');
            $table->bigInteger('day_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->unique(['day_id','locale']);
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('days');
    }
}
