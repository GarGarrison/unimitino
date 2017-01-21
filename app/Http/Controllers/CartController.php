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
        $gids = Cart::select('gid')->where('uid',session('uid'))->get();
        $gids = array_pluck($gids, 'gid');
        if ($gids) $goods = Goods::whereIn('id', $gids)->get();
        return view('util.show_cart', ['goods'=>$goods]);
    }

    public function add_to_cart(Request $request) {
        $uid = session('uid');
        $gid = $request['gid'];
        $count = Cart::where('uid', $uid)->where('gid', $gid)->count();
        if ($count) return response()->json(["success" => false, "message" => "Этот товар уже в корзине!"]);
        Cart::create([
            'uid'=>$uid,
            'gid'=>$gid
            //'count'=>$request->all()->count
        ]);
        return response()->json(["success" => true,"message"=> "Добавлено в корзину"]);
    }

    public function delete_from_cart($ctd) {
        Cart::where('uid', session('uid'))->where('gid', $ctd)->delete();
        return response()->json(['success'=> 'Успешно удалено']);
    }
    // форма с параметрами заказа
    //public function order_params(){ return view("util.order_params");}

    public function make_order(Request $request){
        $uid = session('uid');
        $goods = $request['order'];
        $gids = array();
        foreach($goods as $good) {
            $gid = $good['id'];
            $count = $good['count'];
            $price = $good['price'];
            array_push($gids, $gid);
            Order::create([
                'uid'=> $uid,
                'gid'=> $gid,
                'price'=> $price,
                'count'=> $count,
                'status'=> 0
            ]);
        }
        Cart::where('uid', $uid)->whereIn('gid', $gids)->delete();
        return "Заказ отправлен в работу!";
    }

}
