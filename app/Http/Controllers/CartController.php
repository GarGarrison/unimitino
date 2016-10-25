<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cart;
use App\Goods;
use App\Order;
class CartController extends SharedController
{
    public function show_cart(Request $request) {
        $goods = "";
        $gids = Cart::select('goods_id')->where('uid',session('uid'))->get();
        $gids = array_pluck($gids, 'goods_id');
        if ($gids) $goods = Goods::whereIn('id', $gids)->get();
        return view('util.show_cart', ['goods'=>$goods]);
    }

    public function add_to_cart(Request $request) {
        Cart::create([
            'uid'=>session('uid'),
            'goods_id'=>$request['goods_id']
            //'count'=>$request->all()->count
        ]);
        return "Добавлено в корзину";
    }

    public function delete_from_cart(Request $request) {
        $ctd = $request['id'];
        Cart::destroy($ctd);
        return response()->json(['success'=> 'Успешно удалено']);
    }
    // форма с параметрами заказа
    public function order_params(){ return view("util.order_params");}

    public function make_order(Request $request){
        $uid = session('uid');
        $goods = $request['order'];
        foreach($goods as $good) {
            $gid = $good['id'];
            $count = $good['count'];
            Order::create([
                'uid'=> $uid,
                'gid'=> $gid,
                'count'=> $count,
                'status'=> 0
            ]);
        }
        return "Заказа отправлен в работу!";
    }

}
