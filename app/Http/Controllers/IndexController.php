<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DB;
use App\Http\Requests;
use Carbon\Carbon;
use App\News;
use App\Cart;
use App\Goods;
use App\Rubric;
use App\RubricRelation;
use App\RubricsGoods;
class IndexController extends SharedController
{
    public function index(Request $request) {
        //$uid = $this->getUID($request);
        $now = Carbon::now();
        $actual_news = News::where('unpublic_date','>', $now)->where('public_date','<=', $now)->orderBy('public_date');
        $important_news = clone($actual_news);
        $important = $important_news->where('important', True)->first();
        $new_goods = Goods::where('new', 1)->orderBy('updated_at', 'desc')->take(4)->get();
        $content = view('index', [
            'important'=>$important,
            'actual_news'=>$actual_news->get(),
            'new_goods'=>$new_goods
        ]);
        return $content;
    }
    public function search(Request $request) {
        $view = 'util.search_result';
        if ($request['target']) $view = 'util.search_for_admin';
        $req = $request['req'];
        $result = Goods::where('name', 'like', $req.'%')->get();
        return view($view, ['result'=>$result, 'req'=>$req]);
    }
    public function show_rubric($url) {
        $rubric = Rubric::whereUrl($url)->first();
        $params = false;
        if (!$rubric) abort(404);
        $bread = explode("#", RubricRelation::find($rubric->id)->rubric_parents);
        if ($rubric->has_params) $params = DB::table("rubrics_params")
            ->where('rid', $rubric->id)
            ->join("params", "rubrics_params.pid", "=", "params.id")->get();
        $goods = DB::table('rubrics_goods')
        ->where('rid', $rubric->id)
        ->join('goods', 'rubrics_goods.gid', '=', 'goods.id')->get();
        return view('util.show_rubric', ['goods' => $goods, 'params' => $params, 'bread' => $bread ]);
    }
    public function show_news() {
        $news = News::orderBy('news_date', 'desc')->get();
        return view('util.show_news', ['news' => $news]);
    }
    public function show_new_goods() {
        $new_goods = Goods::where('new', 1)->orderBy('updated_at', 'desc')->get();
        return view('util.show_new_goods', ['new_goods' => $new_goods]);
    }
    public function how_buy() {
        return view('util.how_buy');
    }
    public function contacts() {
        return view('util.contacts');
    }
    public function about() {
        return view('util.about');
    }
}
