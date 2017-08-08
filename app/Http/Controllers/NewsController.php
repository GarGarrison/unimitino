<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Http\Requests;
use App\News;
class NewsController extends SharedController
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
    public function show_add_news() {
        return view('admin.forms.add_news');
    }
    public function show_edit_news() {
        return view('admin.forms.edit_news',['news'=>News::all()]);
    }

    public function add_news(Request $request) {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return $validator->messages();
        }
        News::create([
            'title' => $request['title'],
            'annotation' => $request['annotation'],
            'text' => $request['text'],
            'news_date' => $this->doDateFromFormat($request['news_date_submit']),
            'public_date' => $this->doDateFromFormat($request['public_date_submit']),
            'unpublic_date' => $this->doDateFromFormat($request['unpublic_date_submit'])
        ]);
        return redirect()->back()->with("MSG", "Новость успешно добавлена!");
    }
    public function edit_news(Request $request) {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return $validator->messages();
        }
        $news = News::find($request['id']);
        $news->update([
            'title' => $request['title'],
            'annotation' => $request['annotation'],
            'text' => $request['text'],
            'news_date' => $this->doDateFromFormat($request['news_date_submit']),
            'public_date' => $this->doDateFromFormat($request['public_date_submit']),
            'unpublic_date' => $this->doDateFromFormat($request['unpublic_date_submit'])
        ]);
        return redirect()->back()->with("MSG", "Новость успешно изменена!");
    }
    public function del_news($nid) {
        News::destroy($nid);
        return redirect()->back()->with("MSG", "Новость успешно удалена!");
    }
}
