<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('logo');
            $table->timestamps();
        });
        Schema::create('setting_translations', function (Blueprint $table) {
            $table->increments('settings_trans_id');
            $table->bigInteger('settings_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->text('about');
            $table->text('privacy');
            $table->unique(['settings_id', 'locale']);
            $table->foreign('settings_id')->references('id')->on('settings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
