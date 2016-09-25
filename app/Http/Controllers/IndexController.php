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

class IndexController extends Controller
{
    public function updateUID($cook, $uid) {
        Cart::where('uid', $cook)->update(['uid'=>$uid]);
    }
    public function getUID($request) {
        $cuid = $request->cookie('uid');
        $user = Auth::user();
        $uid = $cuid;
        if (!$uid or !$user) $uid = $user ? $user->id: uniqid();
        elseif ($user) {
            if ( $user->id != $cuid) $this->updateUID($cuid, $user->id);
            $uid = $user->id;
        }
        return $uid;
    }
    public function index(Request $request) {
        $uid = $this->getUID($request);
        $now = Carbon::now();
        $rubrics = Rubric::getDict();
        $rubric_relations = RubricRelation::orderBy('rubric_parents')->get();
        $actual_news = News::where('unpublic_date','>', $now)->where('public_date','<=', $now)->orderBy('public_date');
        $important_news = clone($actual_news);
        $important = $important_news->where('important', True)->first();
        $new_goods = Goods::where('new', 1)->orderBy('updated_at', 'desc')->take(4)->get();
        $cart_length = Cart::where('uid', $uid)->count();
        $content = view('index', [
            'rubrics'=>$rubrics,
            'rubric_relations'=>$rubric_relations,
            'important'=>$important,
            'actual_news'=>$actual_news->get(),
            'new_goods'=>$new_goods,
            'cart_length'=>$cart_length
        ]);
        return response($content)->cookie('uid', $uid, 60);
    }
    public function search(Request $request) {
        $req = $request['req'];
        $result = Goods::where('name', 'like', $req.'%')->get();
        return view('util.search_result', ['result'=>$result, 'req'=>$req]);
    }
}