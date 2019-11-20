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
            $table->string('uid',36);
            $table->string('name')->nullable();
            $table->string('city');
            $table->string('company')->nullable();
            $table->string('post_index');
            $table->string('address');
            $table->string('phone');
            $table->string('qiwi_phone')->nullable();
            $table->string('bank_name');
            $table->string('bank_account');
            $table->string('inn');
            $table->string('email');
            $table->string('type');
            $table->string('money',16);
            $table->integer('gid');
            $table->integer('countorder');
            $table->integer('countdone');
            $table->float('price');
            $table->string('payment',16);
            $table->boolean('payment_status');
            $table->string('delivery_type');
            $table->string('transport_company')->nullable();
            $table->char('delivery_status', 1);
            $table->char('status', 1);
            $table->string('takeplace', 32);
            $table->string('comment')->nullable();
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
