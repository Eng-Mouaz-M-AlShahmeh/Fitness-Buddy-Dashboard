<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('status')->default('1')
                ->comment('0 => inactive, 1 => active');
            $table->bigInteger('resturant_id')->unsigned();
            $table->string('lat');
            $table->string('lng');
            $table->timestamps();
            $table->foreign('resturant_id')->references('id')
                ->on('resturants')->onDelete('cascade');
        });
        Schema::create('branch_translations', function(Blueprint $table)
        {
            $table->increments('branches_trans_id');
            $table->bigInteger('branch_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->unique(['branch_id','locale']);
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
