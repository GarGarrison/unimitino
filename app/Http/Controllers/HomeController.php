<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
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
        return view('home');
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
            //'password' => bcrypt($request['password'])
        ]);
        return view('home');
    }
}
