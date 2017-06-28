<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid',22);
            $table->integer('gid');
            $table->integer('countorder');
            $table->integer('countdone');
            $table->float('price');
            $table->string('money',16);
            $table->string('payment',16);
            $table->boolean('payment_status');
            $table->string('delivery_type');
            $table->string('transport_company');
            $table->char('delivery_status', 1);
            $table->char('status', 1);
            $table->string('clarify_address');
            $table->string('takeplace', 32);
            //$table->integer('storage_time');
            $table->integer('storage_user');
            $table->integer('billid');
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
        Schema::drop('orders');
    }
}
