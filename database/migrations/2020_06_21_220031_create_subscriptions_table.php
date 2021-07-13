<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('price');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
        Schema::create('subscription_translations', function(Blueprint $table)
        {
            $table->increments('subscriptions_trans_id');
            $table->bigInteger('subscription_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->string('currency');
            $table->unique(['subscription_id','locale']);
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
