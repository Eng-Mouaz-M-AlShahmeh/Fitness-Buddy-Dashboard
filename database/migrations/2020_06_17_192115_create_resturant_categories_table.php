<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResturantCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resturant_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('resturant_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('resturant_id')
                ->references('id')->on('resturants')
                ->onDelete('cascade');
        });
        Schema::create('rest_cats_translations', function(Blueprint $table)
        {
            $table->increments('rest_cats_trans_id');
            $table->bigInteger('resturant_category_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->unique(['resturant_category_id','locale']);
            $table->foreign('resturant_category_id')->references('id')->on('resturant_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resturant_categories');
    }
}
