<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_params', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('gid'); // goods id
            $table->smallInteger('rid'); // rubric id
            $table->integer('height'); // Высота, мм
            $table->integer('width'); // Ширина, мм
            $table->integer('length_val'); // Длина вала, мм
            $table->integer('d'); // Диаметр, мм
            $table->integer('i'); // Ток, А
            $table->integer('u'); // Напряжение, В
            $table->integer('r'); // Номинал, КОм
            $table->integer('n'); // Мощность, Вт
            $table->integer('c'); //Ёмкость, мкф
            $table->integer('time'); //Время срабатывания, нс
            $table->integer('channel'); //Число каналов (1/2)
            $table->string('dependence'); //Зависимость (A/B/C/...)
            $table->string('type'); //Тип корпуса
            $table->string('description'); // Описание
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('goods_params');
    }
}
