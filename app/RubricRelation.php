<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RubricRelation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'relation',
    ];
}
