<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('level_index')->unique();
            $table->string('title');
            $table->string('description');
            
            $table->integer('status_id')->unsigned; // referes to the active status_id of the current level (draft/publish/un-publish/deleted)
            $table->integer('user_id')->unsigned();// forner key for user id and needs to be positive(unsigned)
            // $table->unsignedInteger('updated_by_id')->nullable(); //id of last user to edit this level
            // $table->integer('tags'); // create pivot table for many to many relation ship

            $table->timestamp('published_at')->nullable();
            $table->timestamp('deleted_at')->nullable();    
            $table->timestamps();

            // maps relation between forner key and source table    
            $table->foreign('user_id')      // forner key on this table
                    ->references('id')      // refrence on the source table
                    ->on('users')           // table been refrences 
                    ->onDelete('no action'); //this will be in case user deletes the account will cascate down and delete any assiated or map date of it
            
            // $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('no action');
            // $table->foreign('status_id')->references('id')->on('status')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('levels');
    }
}
