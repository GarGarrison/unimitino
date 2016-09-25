<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubricRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubric_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('rubric_id');
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
        Schema::drop('rubric_relations');
    }
}
