<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
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
                        'name' => $request['name']
                    ]);
        $newid = $new_rubric->id;
        $parent = $request['parent'];
        $fullparent = "";
        if ($parent == "") $fullparent = $newid;
        else $fullparent = RubricRelation::where('rubric_id', $parent)->first(['rubric_parents'])->rubric_parents.'#'.$newid;
        RubricRelation::create([
            'rubric_id' => $newid,
            'rubric_parents' => $fullparent
        ]);
        if ($parent) RubricRelation::where('rubric_id',$parent)->update(['has_child'=>True]);
        return response()->json(['success'=> 'Успешно сохранено', 'params'=>['name'=>$request['name'], 'id'=>$newid, 'parent'=>$request['parent']]]);
    }
    public function edit_rubric(Request $request) {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return $validator->messages();
        }
        Rubric::find($request['rubric-to-change'])->update(['name' => $request['name']]);
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
