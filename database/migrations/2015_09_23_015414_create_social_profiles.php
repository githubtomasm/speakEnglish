<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider');
            $table->string('provider_id')->unique();
            $table->string('avatar');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        

            //relation sheep with users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('social_profiles');
    }
}
