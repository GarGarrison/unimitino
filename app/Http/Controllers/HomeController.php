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

    public function full_order() {
            return DB::table("orders")
                        ->where('status',0)
                        ->leftJoin("goods", "orders.gid", "=", "goods.id")
                        ->select('orders.id as oid', 'orders.*', 'goods.*');
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
            $new_orders = $this->full_order();
            $order = $new_orders->first();
            if ($order) {
                $client = User::find($order->uid);
                //$order->status = 1;
                //$order->save();
            }
            $data = ["order" => $order, "client"=>$client, "user"=>$user];
            //dd($data);
        }
        return view($role.'.'.$role, $data);
    }

    // public function show_orders()
    // {
    //     $user = auth()->user();
    //     return view('user.orders', ["orders"=>Order::where('uid', $user->id)->get()]);
    // }

    public function update_user(Request $request){
        $validator = $this->update_user_validator($request->all());
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

    public function user_menu($url)
    {
        return view('user.'.$url);
    }
}
