<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modifiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        Schema::create('modifier_translations', function(Blueprint $table)
        {
            $table->increments('modifiers_trans_id');
            $table->bigInteger('modifier_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('modifier');
            $table->unique(['modifier_id','locale']);
            $table->foreign('modifier_id')->references('id')->on('modifiers')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modifiers');
    }
}
