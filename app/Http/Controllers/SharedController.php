<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use Carbon\Carbon;
use View;
use DB;
use App\Cart;
use App\Rubric;
use App\RubricRelation;

class SharedController extends Controller
{
    public $status = array(
        0 => array(
            "status" => "img/wait.png",
            "maydelete" => "<img class = 'pointer delete-position' src='img/delete.png'>"),
        1 => array(
            "status" => "img/canceled.png",
            "maydelete" => "<img class = 'pointer change-canceled' src='img/order.png'>"),
        2 => array(
            "status" => "img/building.png",
            "maydelete" => ""),
        3 => array(
            "status" => "img/built.png",
            "maydelete" => ""),
        4 => array(
            "status" => "img/built.png",
            "maydelete" => ""),
        5 => array(
            "status" => "img/unavail.png",
            "maydelete" => ""),
        7 => array(
            "status" => "img/not_ordered.png",
            "maydelete" => "<img class = 'pointer delete-position' src='img/delete.png'>"),
        8 => array(
            "status" => "img/built.png",
            "maydelete" => "")
    );

    public function translit($str) {
        $lit_dic = array(
            ' ' => '_',
            ',' => '',
            '/' => '',
            '-' => '_',
            '(' => '',
            ')' => '',
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'e',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'j',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'shc',
            'ъ' => '',
            'ы' => 'i',
            'ь' => '',
            'э' => 'e',
            'ю' => 'ju',
            'я' => 'ja'
        );
        return strtr(mb_strtolower($str), $lit_dic);
    }
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
        View::share('rubrics', Rubric::getDict());
        View::share('rubric_relations', RubricRelation::orderBy('relation')->get());
        View::share('money', Auth::user() ? Auth::user()->money : "руб");
        View::share('price_level', Auth::user() ? Auth::user()->price_level : "price_retail_rub");
        View::share('price_pack', array("$" => "price_pack_usd", "руб" => "price_pack_rub"));
        View::share('status_img', $this->status);
    }
}
