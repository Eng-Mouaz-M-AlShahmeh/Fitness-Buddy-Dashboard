<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('dept_id')->unsigned();
            $table->string('slider');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade');

        });
        Schema::create('dept_slides_trans', function(Blueprint $table)
        {
            $table->increments('dept_slides_trans_id');
            $table->bigInteger('dept_slides_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('title')->nullable();
            $table->string('desc')->nullable();
            $table->unique(['dept_slides_id','locale']);
            $table->foreign('dept_slides_id')->references('id')->on('department_sliders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department_sliders');
    }
}
