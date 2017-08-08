<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RubricRelation extends Model
{
    public $timestamps = false;
    public $primaryKey = "rid";
    public $incrementing = false;

    protected $fillable = [
        'rid',
        'relation',
        'has_child',
    ];
}
