<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use Carbon\Carbon;
use View;
use Session;
use App\Cart;

class SharedController extends Controller
{
    public function getCheckbox($var, $default=0) {
        return isset($var) ? 1: $default;
    }
    public function updateUID($cook, $uid) {
        Cart::where('uid', $cook)->update(['uid'=>$uid]);
    }
    public function getUID() {
        $suid = Session::get('uid');
        $user = Auth::user();
        $uid = $suid;
        if (!$uid and !$user) $uid = $user ? $user->id: uniqid();
        elseif ($user) {
            if ( $user->id != $suid) $this->updateUID($suid, $user->id);
            $uid = $user->id;
        }
        return $uid;
    }
    public function __construct() {
        $uid = $this->getUID();
        //Session::put('uid', $uid);
        $cart_length = Cart::where('uid', $uid)->count();
        View::share('cook', 'here!!'.$uid);
        View::share('cart_length', $cart_length);
    }    
}
