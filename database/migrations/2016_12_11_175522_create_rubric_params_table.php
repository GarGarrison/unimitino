<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubricParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubrics_params', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('rid'); // rubric id
            $table->smallInteger('pid'); // param id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rubrics_params');
    }
}
