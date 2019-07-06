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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:rubrics',
        ]);
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
        $bread = explode("#", $relation->relation);
        $params = DB::table("rubrics_params")
            ->where('rid', $rubric->id)
            ->join("params", "rubrics_params.pid", "=", "params.id")->get();
        $goods = Goods::where('rid', $rubric->id)->paginate(40);
        return view('util.show_rubric', ['goods' => $goods, 'params' => $params, 'bread' => $bread, 'rid' => $rubric->id ]);
    }

    public function show_add_rubric() {
        return view('admin.forms.add_rubric',['rubrics'=>Rubric::all()]);
    }
    public function show_edit_rubric() {
        return view('admin.forms.edit_rubric',['rubrics'=>Rubric::all()]);
    }

    public function add_rubric(Request $request) {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }
        $new_rubric = Rubric::create([
                        'name' => $request['name'],
                        'url' => $this->translit($request['name'])
                    ]);
        $newid = $new_rubric->id;
        $parent = 0;
        // $fullparent = $newid;
        // if ($parent != "") {
        //     $parent_relation = RubricRelation::find($parent);
        //     $fullparent = $parent_relation->relation.'#'.$newid;
        //     $parent_relation->update(['has_child' => 1]);
        // }
        if ($request['parent'] != "") {
            $parent = $request['parent'];
            $parent_relation = RubricRelation::find($parent);
            $parent_relation->update(['has_child' => 1]);
        }
        RubricRelation::create([
                'rid' => $newid,
                'parent' => $parent
            ]);
        return redirect()->back()->with("MSG", "Рубрика успешно добавлена!");
    }
    public function edit_rubric(Request $request) {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }
        Rubric::find($request['rubric-to-change'])->update(['name' => $request['name'], 'url'=> $this->translit($request['name'])]);
        return redirect()->back()->with("MSG", "Рубрика успешно изменена!");
    }
    public function del_rubric($rtd) {
        Rubric::destroy($rtd);
        RubricRelation::destroy($rtd);
        RubricRelation::where("parent", "=", $rtd)->delete();
        return redirect()->back()->with("MSG", "Рубрика успешно удалена!");
    }
}
