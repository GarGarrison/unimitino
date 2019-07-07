<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Validator;
use App\Goods;
use App\Rubric;
use App\RubricRelation;

class RubricController extends SharedController
{
    // public function __construct(){
    //     $this->rubricDict = RubricRelation::getRelationDict();
    // }

    protected $recursive_counter = 0;
    protected $rubric_storage = array();

    protected function uniqValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:rubrics',
            'parent' => 'numeric'
        ]);
    }

    protected function notUniqValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'parent' => 'numeric'
        ]);
    }

    public function rubric_tree($id) {
        $this->recursive_counter ++;
        if ($this->recursive_counter > 100) dd("RECURSIVE ERROR");
        
        $children = array_keys( RubricRelation::getRelationDict(), $id);
        if ( count($children) > 0 ) {
            foreach ($children as $child) {
                $this->rubric_storage = array_merge($this->rubric_storage, $children);
                $this->rubric_tree( $child );
            }
        }
    }

    public function rubric_parents($id) {
        $this->recursive_counter ++;
        if ($this->recursive_counter > 100) dd("RECURSIVE ERROR");
        $parent = RubricRelation::getRelationDict()[$id];
        if ( $parent != 0 ) {
            array_push( $this->rubric_storage, $parent );
            $this->rubric_parents($parent);
        }
    }

    public function recursive($id, $func_name) {
        $this->recursive_counter = 0;
        $this->rubric_storage = array();
        $this->{$func_name}($id);
        $rez = $this->rubric_storage;
        $this->rubric_storage = array();
        $this->recursive_counter = 0;
        return $rez;
    }

    public function filter_rubric(Request $request) {
        $rid = $request['rid'];
        $params = $request['params'];
        $filter = DB::table("goods_params")->where("goods_params.rid", $rid);
        foreach ($params as $p) {
            $filter = $filter->where("goods_params.".$p["column"], $p["operation"], $p["value"]);
        }
        $goods = $filter->join('goods', 'goods_params.gid', '=', 'goods.id')->get();
        return view('util.filter_rubric', ['goods' => $goods]);
    }

    public function show_rubric($relid, $url) {
        $rubric = Rubric::whereUrl($url)->first();
        $relation = RubricRelation::find($relid);
        if (!$rubric) abort(404);
        $bread = $this->recursive($rubric->id, "rubric_parents");
        // dd($bread);
        // $bread = explode("#", $relation->relation);

        // $bread = array($rubric->id);
        $goods = array();
        $params = DB::table("rubrics_params")
            ->where('rid', $rubric->id)
            ->join("params", "rubrics_params.pid", "=", "params.id")->get();
        $goods = Goods::where('rid', $rubric->id)->paginate(40);
        // dd($goods);
        return view('util.show_rubric', ['goods' => $goods, 'params' => $params, 'bread' => $bread, 'rid' => $rubric->id ]);
    }

    public function show_add_rubric() {
        return view('admin.forms.add_rubric',['rubrics'=>Rubric::all()]);
    }
    public function show_edit_rubric() {
        return view('admin.forms.edit_rubric',['rubrics'=>Rubric::all()]);
    }

    public function add_rubric(Request $request) {
        $validator = $this->uniqValidator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }
        $new_rubric = Rubric::create([
                        'name' => $request['name'],
                        'url' => $this->translit($request['name'])
                    ]);
        $newid = $new_rubric->id;
        $parent = $request['parent'];
        RubricRelation::create([
                'rid' => $newid,
                'parent' => $parent
            ]);
        return redirect()->back()->with("MSG", "Рубрика успешно добавлена!");
    }
    public function edit_rubric(Request $request) {
        // $validator = $this->uniqValidator($request->all());
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator->messages());
        // }
        $rubric = Rubric::find($request['rubric-to-change']);
        if ( $rubric->id == $request['parent'] ) {
            return redirect()->back()->withErrors(array("parent" => "Рубрика не может быть родительской сама себе"));
        }
        if ($rubric->name != $request['name']) {
            $validator = $this->uniqValidator($request->all());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->messages());
            }
        }
        else {
            $validator = $this->notUniqValidator($request->all());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->messages());
            } 
        }
        $rubric->update(['name' => $request['name'], 'url'=> $this->translit($request['name'])]);
        RubricRelation::find($request['rubric-to-change'])->update(['parent' => $request['parent'] ]);
        return redirect()->back()->with("MSG", "Рубрика успешно изменена!");
    }
    public function del_rubric($rtd) {
        $this->rubric_storage = array($rtd);
        $this->rubric_tree($rtd);
        $array_to_delete = array_unique($this->rubric_storage);
        $this->rubric_storage = array();
        $this->recursive_counter = 0;
        Rubric::whereIn('id', $array_to_delete)->delete();
        RubricRelation::whereIn('rid', $array_to_delete)->delete();
        return redirect()->back()->with("MSG", "Рубрика успешно удалена!");
    }
}
