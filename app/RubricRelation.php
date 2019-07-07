<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rubric;

class RubricRelation extends Model
{
    public $timestamps = false;
    public $primaryKey = "rid";
    public $incrementing = false;

    protected $fillable = [
        'rid',
        'parent',
        'has_child',
    ];
    public static function getDict() {
        $all = RubricRelation::all();
        $rez = array();
        foreach ($all as $a) {
            $rez[$a['rid']] = array(
                'parent' => $a['parent'],
                'has_child' => $a['has_child']
            );
        }
        return $rez;
    }
    public static function getRelationDict() {
        $all = RubricRelation::orderBy('rid')->get();
        $rez = array();
        foreach ($all as $a) {
            $rez[$a['rid']] = $a['parent'];
        }
        return $rez;
    }
}
