<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    public $timestamps = false;
    
    protected $table = 'goods';

    protected $guarded = ['id',];
}
