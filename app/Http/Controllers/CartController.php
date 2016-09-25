<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cart;
use App\Goods;
class CartController extends Controller
{
    public function show_cart(Request $request) {
        $goods = "";
        $gids = Cart::select('goods_id')->where('uid',$request->cookie('uid'))->get();
        $gids = array_pluck($gids, 'goods_id');
        if ($gids) $goods = Goods::whereIn('id', $gids)->get();
        return view('util.show_cart', ['goods'=>$goods]);
    }
    public function add_to_cart(Request $request) {
        Cart::create([
            'uid'=>$request->cookie('uid'),
            'goods_id'=>$request['goods_id']
            //'count'=>$request->all()->count
        ]);
        return "Ok";
    }
    public function delete_from_cart(Request $request) {
        $ctd = $request['id'];
        Cart::destroy($ctd);
        return response()->json(['success'=> 'Успешно удалено']);
    }

    public function order_params(){ return view("util.order_params");}

    public function make_order(Request $request){
        return $request->all();
    }

}
