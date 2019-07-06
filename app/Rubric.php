<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RubricRelation;

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
    // public function delete() {
    //     $id = $this->id;
    //     RubricRelation::find($id)->delete();
    //     return parent::delete();
    // }
}
