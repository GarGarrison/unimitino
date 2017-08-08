<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\News;
use App\Goods;
use App\User;

class IndexController extends SharedController
{
    public function index(Request $request) {
        $important = News::orderBy('public_date')->first();
        $new_goods = Goods::where('new', 1)->orderBy('updated_at', 'desc')->take(4)->get();
        return view('index', ['important'=>$important, 'new_goods'=>$new_goods]);
    }
    public function search(Request $request) {
        $view = 'util.search_result';
        if ($request['target']) $view = 'util.search_for_admin';
        $req = $request['req'];
        $result = Goods::where('typonominal', 'like', '%'.$req.'%')->get();
        return view($view, ['result'=>$result, 'req'=>$req]);
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
