<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Carbon\Carbon;
use App\Http\Requests;
use App\News;
class NewsController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|max:255|unique:news',
            'annotation' => 'required',
            'text' => 'required',
            'news_date' => 'required',
            'public_date' => 'required',
            'unpublic_date' => 'required',
        ]);
    }
    protected function doDateFromFormat ($date, $setToZero=True) {
        $format = "Y/m/d";
        if ($setToZero) return Carbon::createFromFormat($format, $date)->setTime(0,0,0);
        else return Carbon::createFromFormat($format, $date);
    }
    public function show_add_news($id = "") {
        $current_news = '';
        if ($id) $current_news = News::find($id);
        return view('admin.forms.add_news',['current_news'=>$current_news]);
    }
    public function show_edit_news() {
        //return "ololo";
        return view('admin.forms.edit_news',['news'=>News::all()]);
    }

    public function add_news(Request $request) {
        //return response()->json(['success'=> 'Успешно сохранено']);
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return $validator->messages();
        }
        News::create([
            'title' => $request['title'],
            'annotation' => $request['annotation'],
            'text' => $request['text'],
            'important' => $this->getCheckbox($request['important']),
            'news_date' => $this->doDateFromFormat($request['news_date_submit']),
            'public_date' => $this->doDateFromFormat($request['public_date_submit']),
            'unpublic_date' => $this->doDateFromFormat($request['unpublic_date_submit'])
        ]);
        return response()->json(['success'=> 'Успешно сохранено']);
    }
    public function edit_news(Request $request) {
        $news = News::find($request['id']);
        $news->update([
            'title' => $request['title'],
            'annotation' => $request['annotation'],
            'text' => $request['text'],
            'important' => $this->getCheckbox($request['important']),
            'news_date' => $this->doDateFromFormat($request['news_date_submit']),
            'public_date' => $this->doDateFromFormat($request['public_date_submit']),
            'unpublic_date' => $this->doDateFromFormat($request['unpublic_date_submit'])
        ]);
        $news->save();
        return response()->json(['success'=> 'Успешно изменено', 'params'=>['name'=>$request['new-name'], 'id'=>$request['rubric-to-change']]]);
    }
    public function del_news(Request $request) {
        $ntd = $request['id'];
        News::destroy($ntd);
        return response()->json(['success'=> 'Успешно удалено', 'params'=>['id'=>$ntd]]);
    }
}
