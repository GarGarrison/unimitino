<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubrics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('url');
            $table->string('rubric_parents');
            $table->boolean('has_child')->default(False);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rubrics');
    }
}
