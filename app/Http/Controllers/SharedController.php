<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use Carbon\Carbon;
use View;
use DB;
use App\Cart;

class SharedController extends Controller
{
    public function getCheckbox($var, $default=0) {
        return isset($var) ? 1: $default;
    }
    public function updateUID($cook, $uid) {
        Cart::where('uid', $cook)->update(['uid'=>$uid]);
        $duplicates = array_pluck(Cart::select('id', DB::raw('count(id) as count'))->groupBy('gid')->having('count', '>', 1)->get(), 'id');
        Cart::whereIn('id', $duplicates)->delete();
    }
    public function getUID() {
        $suid = session('uid');
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
        session(['uid' => $uid]);
        View::share('cart_length', Cart::where('uid', $uid)->count());
    }
}
