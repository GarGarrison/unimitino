<?php

namespace App\Http\Controllers;

use Socialite;
use Auth;
use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Goods;
class HomeController extends SharedController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        $data = array();
        if ($role == "storage") {
            $client = "";
            $order = DB::table("orders")
                        ->where('status',0)
                        ->leftJoin("goods", "orders.gid", "=", "goods.id")
                        ->select('orders.id as oid', 'orders.*', 'goods.*')->first();
            if ($order) {
                $client = User::find($order->uid);
                //dd($client);
                $order_to_save = Order::find($order->oid);
                $order_to_save->status = 2;
                $order_to_save->save();
            }
            $data = ["order" => $order, "client"=>$client, "user"=>$user];
        }
        if ($role == "admin"){
            $orders = Order::paginate(40);
            $data = ["orders"=>$orders];
        }
        return view($role.'.'.$role, $data);
    }

    public function update_user(Request $request){
        $validator = $this->get_validator($request->all(), "update_user_validator");
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }
        $user = Auth::user();
        $pass = $request['password'];
        $data = [
            'type' => $request['user_type'],
            'name' => $request['name'],
            'city' => $request['city'],
            'company' => $request['company'],
            'post_index' => $request['post_index'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'bank_name' => $request['bank_name'],
            'bank_account' => $request['bank_account'],
            'inn' => $request['inn'],
            'email' => $request['email']
        ];
        if ($pass) $data['password'] = bcrypt($pass);
        $user->update($data);
        return redirect('/home');
    }

    public function user_menu_profile() {
        return view('user.profile');
    }

    public function user_menu_track() {
        $orders = DB::table("orders")
                    ->where('uid', session('uid'))
                    ->where('status', '<', 6)
                    ->leftJoin("goods", "orders.gid", "=", "goods.id")
                    ->select('orders.id as oid', 'orders.*', 'goods.*')->get();

        return view('user.track', ['orders' => $orders]);
    }

    public function user_menu_history() {
        /*
            dic item:
            [   
                items => array()
                sum =>
                money =>
                date =>
            ]
        */
        $dic = array();
        $orders = DB::table("orders")
                    ->where('uid', session('uid'))
                    ->where('billid', '<>', 0)
                    ->leftJoin("goods", "orders.gid", "=", "goods.id")
                    ->select('orders.id as oid', 'orders.created_at as order_created_at', 'orders.*', 'goods.*')->get();

        foreach ($orders as $o) {
            if (array_key_exists($o->billid, $dic)) {
                array_push($dic[$o->billid]["items"], $o);
                $dic[$o->billid]["sum"] += $o->price * $o->countdone;
            }
            else {
                $dic[$o->billid]["items"] = [$o];
                $dic[$o->billid]["sum"] = $o->price * $o->countdone;
                $dic[$o->billid]["money"] = $o->money;
                $dic[$o->billid]["date"] = $o->order_created_at;
            }
        }
        return view('user.history', ["bills" => $dic]);
    }

    public function delete_order($oid) {
        $order = Order::find($oid);
        $order->status = 1;
        $order->save();
        return "Успешно удалено!";
    }

    public function back_to_order($oid) {
        $order = Order::find($oid);
        $order->status = 0;
        $order->save();
        return "Позиция возвращена в заказ!";
    }
}
