<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = ['id',];

    public static function getDict($uid) {
        $all = Cart::where('uid', '=', $uid)->get();
        $rez = array();
        foreach ($all as $a) {
            $rez[$a['gid']] = $a["count"];
        }
        return $rez;
    }
}
