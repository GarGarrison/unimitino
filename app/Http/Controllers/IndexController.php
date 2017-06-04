<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\News;
use App\Goods;

$long_desc = "
<div>
</div>
";

class IndexController extends SharedController
{
    public function prepare_bd() {
        Goods::all()->update(['description_long' => $long_desc, 'new' => 1]);
    }
    public function index(Request $request) {
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
        $result = Goods::where('goodsname', 'like', '%'.$req.'%')->get();
        return view($view, ['result'=>$result, 'req'=>$req]);
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
        return view('how_buy');
    }
    public function contacts() {
        return view('contacts');
    }
    public function about() {
        return view('about');
    }
}
