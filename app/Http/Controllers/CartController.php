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
        $price = $request['price'];
        $money = $request['money'];
        $exist = Cart::where('uid', $uid)->where('gid', $gid)->count();
        if ($exist) return response()->json(["success" => false, "message" => "Этот товар уже в корзине!"]);
        Cart::create([
            'uid'=>$uid,
            'gid'=>$gid,
            'count'=>$count,
            'price'=>$price,
            'money'=>$money
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

    public function payment(){
        return view('util.payment');
    }

    public function make_order(Request $request){
        $uid = session('uid');
        $carts = Cart::where('uid', $uid)->get();
        if ($carts->isEmpty()) return redirect('/');
        $validator = $this->get_validator($request->all(), "order_validator");
        if ($validator->fails()) return redirect()->back()->withErrors($validator->messages());
        
        foreach($carts as $cart) {
            Order::create([
                'uid'=> $uid,
                'type' => $request['user_type'],
                'name' => $request['name'],
                'city' => $request['city'],
                'company' => $request['company'],
                'post_index' => $request['post_index'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'qiwi_phone' => $request['qiwi_phone'],
                'bank_name' => $request['bank_name'],
                'bank_account' => $request['bank_account'],
                'inn' => $request['inn'],
                'email' => $request['email'],
                'gid'=> $cart->gid,
                'price'=> $cart->price,
                'countorder'=> $cart->count,
                'status'=> 0,
                'money' => $cart->money,
                'payment' => $request['payment'],
                'payment_status' => 0,
                'delivery_type' => $request['delivery_type'],
                'transport_company' => $request['transport_company'],
                'comment' => $request['comment']
            ]);
        }
        Cart::where('uid', $uid)->delete();
        if ($request['pay'] == "paykeeper" ) return redirect("/payment");
        else return redirect("/")->with("MSG", "Заказ отправлен в работу!");
    }

}
