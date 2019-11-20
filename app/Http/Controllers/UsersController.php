<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use DB;

class UsersController extends SharedController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show_users(Request $request) {
        $users = DB::table("users");
        foreach ($request->all() as $k => $v) {
            if ($v && $k != "page") {
                if ($k == "name") $users = $users->where("name", 'like', '%'.$v.'%')->orWhere("company", 'like', '%'.$v.'%');
                else $users = $users->where($k, 'like', '%'.$v.'%');
            }
        }
        $users = $users->paginate(30);
        $users->setPath($request->fullUrl());
        return view('admin.users', ["users"=>$users]);
    }

    public function del_user($uid) {
        User::destroy($uid);
        return redirect()->back()->with("MSG", "Пользователь успешно удален!");
    }

    public function save_user($uid, Request $request) {
        $user = User::find($uid);
        $user->update([
            'price_level' => $request['price_level'],
            'money' => $request['money']
        ]);
        return redirect()->back()->with("MSG", "Пользователь успешно обнавлен!");
    }
}
