<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        Schema::create('department_translations', function(Blueprint $table)
        {
            $table->increments('departments_trans_id');
            $table->bigInteger('department_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->string('title');
            $table->unique(['department_id','locale']);
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
