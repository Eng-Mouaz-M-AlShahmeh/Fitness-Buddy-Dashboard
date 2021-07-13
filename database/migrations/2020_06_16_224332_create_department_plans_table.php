<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('dept_id')->unsigned();
            $table->bigInteger('plan_id')->unsigned();
            $table->timestamps();
            $table->foreign('dept_id')
                ->references('id')->on('departments')
                ->onDelete('cascade');
            $table->foreign('plan_id')
                ->references('id')->on('plans')
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
        Schema::dropIfExists('department_plans');
    }
}
