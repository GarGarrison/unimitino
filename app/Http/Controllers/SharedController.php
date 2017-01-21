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
    public function translit($str) {
        $lit_dic = array(
            ' ' => '_',
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
        return strtr($str, $lit_dic);
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
        View::share('rubric_relations', RubricRelation::orderBy('rubric_parents')->get());
    }
}
