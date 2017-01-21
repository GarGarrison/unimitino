<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RubricsGoods extends Model
{
    public $timestamps = false;
    
    protected $table = 'rubrics_goods';

    protected $guarded = ['id',];
}
