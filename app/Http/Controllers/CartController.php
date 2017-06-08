<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Cart;
use App\Goods;
use App\Order;
class CartController extends SharedController
{
    public function get_cart() {
        return DB::table("carts")
                    ->where('uid',session('uid'))
                    ->leftJoin("goods", "carts.gid", "=", "goods.id")
                    ->select('carts.id as cid', 'carts.*', 'goods.*')->get();
    }
    public function show_cart() {
        $goods = $this->get_cart();
        return view('util.show_cart', ['goods'=>$goods]);
    }

    public function add_to_cart(Request $request) {
        $uid = session('uid');
        $gid = $request['gid'];
        $count = $request['count'];
        $exist = Cart::where('uid', $uid)->where('gid', $gid)->count();
        if ($exist) return response()->json(["success" => false, "message" => "Этот товар уже в корзине!"]);
        Cart::create([
            'uid'=>$uid,
            'gid'=>$gid,
            'count'=>$count
        ]);
        return response()->json(["success" => true,"message" => "Добавлено в корзину!"]);
    }

    public function delete_from_cart($ctd) {
        Cart::where('uid', session('uid'))->where('id', $ctd)->delete();
        return response()->json(["success" => true, "message" => "Успешно удалено!"]);
    }

    public function update_count(Request $request) {
        $cid = $request['cid'];
        $v = $request['value'];
        Cart::find($cid)->update(['count' => $v]);
        return response()->json(["success" => true, "message" => "Успешно изменено!"]);
    }

    public function checkout(){
        return view('util.checkout');
    }

    public function payment()
    {
        return view('util.payment');
    }

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
