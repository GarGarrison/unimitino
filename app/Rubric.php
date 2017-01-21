<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'name','url'
    ];

    public static function getDict() {
        $all = Rubric::all();
        $rez = array();
        foreach ($all as $a) {
            $rez[$a['id']] = array(
                'name' => $a['name'],
                'url' => $a['url']
            );
        }
        return $rez;
    }
}
