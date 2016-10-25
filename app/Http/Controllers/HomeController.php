<?php

namespace App\Http\Controllers;

use Validator;
use Socialite;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Order;
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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'max:255',
            'email' => 'email|max:255|unique:users',
            'password' => 'min:3|confirmed',
            'post_index' => 'integer',
            'inn' => 'integer',
            'bank_account' => 'integer'
        ]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = Auth::user()->type;
        return view($type.'.'.$type);
    }

    public function show_orders()
    {
        $user = auth()->user();
        return view('user.orders');
    }

    public function update_user(Request $request){
        $validator = $this->validator($request->all());
        // if ($validator->fails()) {
        //     return $validator->messages();
        // }
        $user = Auth::user();
        $user->update([
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
        ]);
        return redirect('home.home');
    }
}
