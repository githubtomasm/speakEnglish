<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('video_id')->unique();
            $table->integer('lesson_index');

            $table->unsignedInteger('level_id')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('status_id')->unsigned();

            
            $table->timestamp('published_at');
            $table->timestamp('deleted_at');            
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('set null');
            // $table->foreign('status_id')->references('id')->on('tags')->onDelete('no action');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lessons');
    }
}
