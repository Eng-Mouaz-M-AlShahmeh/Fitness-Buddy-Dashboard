<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResturantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resturants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('dept_id')->unsigned()->default(1);
            $table->bigInteger('plan_id')->unsigned();
            $table->boolean('type');
            $table->bigInteger('city_id')->unsigned();
            $table->string('price_delivery');
            $table->string('icon');
            $table->string('image');
            $table->string('lat');
            $table->string('lng');
            $table->boolean('status')->default('0');
            $table->boolean('closed');
            $table->string('mins');
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
        });

        Schema::create('resturant_translations', function(Blueprint $table)
        {
            $table->increments('resturants_trans_id');
            $table->bigInteger('resturant_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->string('offer');
            $table->string('min');
            $table->string('price');
            $table->text('terms');
            $table->unique(['resturant_id','locale']);
            $table->foreign('resturant_id')->references('id')->on('resturants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resturants');
    }
}
