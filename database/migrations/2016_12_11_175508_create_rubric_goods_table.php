<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubricGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubrics_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('rid'); // rubric id
            $table->smallInteger('gid'); // goods id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rubrics_goods');
    }
}
