<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile')->unique();
            $table->string('password');
            $table->string('image')->default('avatar.png');
            $table->string('firebase_token');
            $table->string('jwt');
            $table->boolean('logged')->default('0');
            $table->boolean('verified_status')->default('0');
            $table->string('length')->nullable();
            $table->string('weight')->nullable();
            $table->string('age')->nullable();
            $table->string('subscription_number')->nullable();
            $table->boolean('social')->default('0');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
