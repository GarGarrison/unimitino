<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RubricsParams extends Model
{
    public $timestamps = false;
    
    protected $table = 'rubrics_params';

    protected $guarded = ['id',];
}
