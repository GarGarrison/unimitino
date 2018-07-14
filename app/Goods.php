<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    public $timestamps = false;
    
    protected $table = 'goods';
    protected $fillable = [
        "rid",
        "num",
        "address",
        "typonominal",
        "mark",
        "producer",
        "case",
        "price_retail_usd",
        "price_retail_rub",
        "price_minitrade_usd",
        "price_minitrade_rub",
        "price_trade_rub",
        "price_trade_usd",
        "packcount",
        "price_pack_usd",
        "price_pack_rub",
        "onlinecount",
        "offlinecount",
        "cell",
        "description",
        "description_long",
        "new",
        "supply",
        "img",
    ];
    // protected $guarded = ['id',];
}
