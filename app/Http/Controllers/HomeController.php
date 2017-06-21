<?php

namespace App\Http\Controllers;

use Validator;
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

    protected function update_validator(array $data)
    {
        $rules = [
            'name' => 'max:255',
            'company' => 'max:255',
            'city' => 'max:255',
            'address' => 'max:255',
            'email' => 'required|email|max:255',
            'password' => 'min:3|confirmed',
            'post_index' => 'integer',
            'inn' => 'integer',
            'bank_account' => 'integer',
            'bank_name' => 'max:255'
        ];
        $messages = [
            'email.unique' => 'Такая электронная почта уже зарегистрирована',
            'email.required' => 'Поле E-mail должно быть заполнено',
            'max' => 'Это поле не может превышать 255 символов',
            'integer' => 'Это поле должно содержать только цифры',
            'password.min' => 'Пароль должен содержать не менее 3 символов'

        ];
        return Validator::make($data, $rules, $messages);
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
            $new_orders = $this->full_order();
            $order = $new_orders->first();
            if ($order) {
                //$good = Goods::find($order->gid);
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
        $validator = $this->update_validator($request->all());
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
