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
        $filter = DB::table("goods_params")->where("rid", $rid);
        foreach ($params as $p) {
            $filter = $filter->where("goods_params.".$p["column"], $p["operation"], $p["value"]);
        }
        $goods = $filter->join('goods', 'goods_params.gid', '=', 'goods.id')->get();
        return view('util.filter_rubric', ['goods' => $goods]);
    }

    public function show_rubric($relid, $url) {
        $rubric = Rubric::whereUrl($url)->first();
        $relation = RubricRelation::find($relid);
        //$params = false;
        if (!$rubric) abort(404);
        $bread = explode("#", $relation->relation);
        //if ($rubric->has_params) $params = DB::table("rubrics_params")
        $params = DB::table("rubrics_params")
            ->where('rid', $rubric->id)
            ->join("params", "rubrics_params.pid", "=", "params.id")->get();

        // $goods = DB::table('rubrics_goods')
        // ->where('rid', $rubric->id)
        // ->join('goods', 'rubrics_goods.gid', '=', 'goods.id')->get();
        $goods = Goods::where('rid', $rubric->id)->paginate(40);
        //dd($goods);
        return view('util.show_rubric', ['goods' => $goods, 'params' => $params, 'bread' => $bread, 'rid' => $rubric->id ]);
    }

    public function show_add_rubric() {
        return view('admin.forms.add_rubric',['rubrics'=>Rubric::all()]);
    }
    public function show_edit_rubric() {
        return view('admin.forms.edit_rubric',['rubrics'=>Rubric::all()]);
    }

    public function add_rubric(Request $request) {
        //return response()->json(['success'=> 'Успешно сохранено']);
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return $validator->messages();
        }
        $new_rubric = Rubric::create([
                        'name' => $request['name'],
                        'url' => $this->translit($request['name'])
                    ]);
        $newid = $new_rubric->id;
        $parent = $request['parent'];
        $fullparent = $newid;
        if ($parent != "") {
            $parent_rubric = Rubric::find($parent);
            $fullparent = $parent_rubric->rubric_parents.'#'.$newid;
            $parent_rubric->has_child = True;
            $parent_rubric->save();
        }
        $new_rubric->rubric_parents = $fullparent;
        $new_rubric->save();
        return response()->json(['success'=> 'Успешно сохранено', 'params'=>['name'=>$request['name'], 'id'=>$newid, 'parent'=>$request['parent']]]);
    }
    public function edit_rubric(Request $request) {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return $validator->messages();
        }
        Rubric::find($request['rubric-to-change'])->update(['name' => $request['name'], 'url'=> $this->translit($request['name'])]);
        return response()->json(['success'=> 'Успешно изменено', 'params'=>['name'=>$request['name'], 'id'=>$request['rubric-to-change']]]);
    }
    public function del_rubric(Request $request) {
        $rtd = $request['id'];
        $rubric_to_update = RubricRelation::where('rubric_parents', 'LIKE', "$rtd#%")
                                          ->orWhere('rubric_parents', 'LIKE', "%#$rtd#%")->get();
        foreach ($rubric_to_update as $rtu) {
            $rtu->rubric_parents = str_replace("$rtd#", "", $rtu->rubric_parents);
            $rtu->save();
        }
        Rubric::destroy($rtd);
        RubricRelation::where('rubric_id', $rtd)->delete();
        return response()->json(['success'=> 'Успешно удалено', 'params'=>['id'=>$rtd]]);
    }
}
