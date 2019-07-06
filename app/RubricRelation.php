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
    // public function delete() {
    //     $rid = $this->rid;
    //     //RubricRelation::find($id)->delete();
    //     $childs = RubricRelation::where("parent", "=", $rid)->pluck('rid')->toArray();
    //     // dd(Rubric::find($childs));
    //     // dd( Rubric::whereIn('id', $childs) );
    //     if (count($childs) > 0) {
    //         Rubric::whereIn('id', $childs)->delete();
    //         //Rubric::find($childs)->delete();
    //     }
    //     return parent::delete();
    // }
}
