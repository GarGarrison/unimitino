<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rid');
            $table->string('num', 32);
            $table->string('address');
            $table->string('typonominal');
            $table->string('mark');
            $table->string('producer');
            $table->string('case');
            $table->float('price_retail_usd');
            $table->float('price_retail_rub');
            $table->float('price_minitrade_usd');
            $table->float('price_minitrade_rub');
            $table->float('price_trade_rub');
            $table->float('price_trade_usd');
            $table->integer('packcount');
            $table->float('price_pack_usd');
            $table->float('price_pack_rub');
            $table->integer('onlinecount');
            $table->integer('offlinecount');
            $table->string('cell', 32);
            $table->text('description');
            $table->text('description_long');
            $table->boolean('new')->default(False);
            $table->boolean('supply')->default(False);
            $table->string('img');
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
        Schema::drop('goods');
    }
}