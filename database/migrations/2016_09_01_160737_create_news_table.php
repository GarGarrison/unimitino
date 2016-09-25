<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('annotation');
            $table->text('text');
            $table->boolean('important')->default(False);
            $table->dateTime('news_date'); // дата для пользователя
            $table->dateTime('public_date'); // дата автоматической публикации
            $table->dateTime('unpublic_date'); // дата прекращения публикации
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('news');
    }
}
