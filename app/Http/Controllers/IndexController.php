<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Carbon\Carbon;
use App\News;
use App\Cart;
use App\Goods;
use App\Rubric;
use App\RubricRelation;

class IndexController extends SharedController
{
    public function index(Request $request) {
        //$uid = $this->getUID($request);
        $now = Carbon::now();
        $rubrics = Rubric::getDict();
        $rubric_relations = RubricRelation::orderBy('rubric_parents')->get();
        $actual_news = News::where('unpublic_date','>', $now)->where('public_date','<=', $now)->orderBy('public_date');
        $important_news = clone($actual_news);
        $important = $important_news->where('important', True)->first();
        $new_goods = Goods::where('new', 1)->orderBy('updated_at', 'desc')->take(4)->get();
        $content = view('index', [
            'rubrics'=>$rubrics,
            'rubric_relations'=>$rubric_relations,
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
}
