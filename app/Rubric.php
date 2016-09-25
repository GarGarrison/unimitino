<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'name',
    ];

    public static function getDict() {
        $all = Rubric::all();
        $rez = array();
        foreach ($all as $a) {
            $rez[$a['id']] = $a['name'];
        }
        return $rez;
    }
}
