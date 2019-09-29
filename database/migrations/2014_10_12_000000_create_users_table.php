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
            $table->string('id',36);
            $table->string('name')->nullable();
            $table->string('city')->nullable();
            $table->string('company')->nullable();
            $table->string('post_index')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('inn')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('type')->default("fiz");
            $table->string('role')->default("user");
            $table->string('money')->default("руб");
            $table->string('price_level')->default("price_retail_rub");
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
        Schema::drop('users');
    }
}
