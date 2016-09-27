<?php

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
            $table->increments('id');
            $table->string('name');
            $table->string('city');
            $table->string('company');
            $table->string('post_index');
            $table->string('address');
            $table->string('phone');
            $table->string('bank_name');
            $table->string('bank_account');
            $table->string('inn');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->dateTime('created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
