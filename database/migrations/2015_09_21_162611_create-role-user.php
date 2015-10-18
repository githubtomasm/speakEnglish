<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * PIVOT TABLE, RELATIONSHIP ROLES AND USERS
 */
class CreateRoleUser extends Migration
{
    /**
     * Run the migrations.
     * Table bridge between roles and users
     * @return void
     */


    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            // $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('role_id')->unsigned()->index();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        
            $table->timestamps();

            // connection will be the identifier for this tablle
            $table->primary(['role_id', 'user_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role_user');
    }
}
