<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsParams extends Model
{
    public $timestamps = false;
    
    protected $table = 'goods_params';

    protected $guarded = ['id',];
}
