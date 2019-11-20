<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use Carbon\Carbon;
use View;
use DB;
use Validator;
use App\Cart;
use App\Goods;
use App\Rubric;
use App\RubricRelation;

class SharedController extends Controller
{
    # order statuses
    # 0 - ожидание
    # 1 - отменено
    # 2 - в наборе
    # 3 - набрано (не полностью)
    # 4 - набрано (полностью)
    # 5 - нет на складе
    # 6 - отгружено
    # //7 - набирать

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
     //    *
     // * 
     // * Generate v4 UUID
     // * 
     // * Version 4 UUIDs are pseudo-random.
     
    // public static function v4() 
    // {
    //     return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

    //         // 32 bits for "time_low"
    //         mt_rand(0, 0xffff), mt_rand(0, 0xffff),

    //         // 16 bits for "time_mid"
    //         mt_rand(0, 0xffff),

    //         // 16 bits for "time_hi_and_version",
    //         // four most significant bits holds version number 4
    //         mt_rand(0, 0x0fff) | 0x4000,

    //         // 16 bits, 8 bits for "clk_seq_hi_res",
    //         // 8 bits for "clk_seq_low",
    //         // two most significant bits holds zero and one for variant DCE1.1
    //         mt_rand(0, 0x3fff) | 0x8000,

    //         // 48 bits for "node"
    //         mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    //     );
    // }
    public $validator_messages = [
            'email.unique' => 'Такая электронная почта уже зарегистрирована',
            'email.required' => 'Поле E-mail должно быть заполнено',
            'max' => 'Это поле не может превышать :max символов',
            'numeric' => 'Это поле должно содержать только цифры',
            'password.min' => 'Пароль должен содержать не менее :min символов',
            'password.confirmed' => 'Пароль и его подтверждение не совпадают',
            'qiwi_phone.required_if' => 'Для выставления счета в QIWI нужно заполнить телефон'
        ];

    public $rules = [
        "reset_password_validator" => [
                                        'token' => 'required',
                                        'email' => 'required|email',
                                        'password' => 'required|confirmed|min:3',
                                    ],
        "update_user_validator" => [
                                        'name' => 'max:255',
                                        'company' => 'max:255',
                                        'city' => 'max:255',
                                        'address' => 'max:255',
                                        'email' => 'required|email|max:255',
                                        'phone' => 'max:255',
                                        'password' => 'min:3|confirmed',
                                        'post_index' => 'numeric',
                                        'inn' => 'numeric',
                                        'bank_account' => 'numeric',
                                        'bank_name' => 'max:255'
                                    ],
        "new_user_validator" => [
                                        'name' => 'max:255',
                                        'company' => 'max:255',
                                        'city' => 'max:255',
                                        'address' => 'max:255',
                                        'phone' => 'max:255',
                                        'email' => 'required|email|max:255|unique:users',
                                        'password' => 'required|min:3|confirmed',
                                        'post_index' => 'numeric',
                                        'inn' => 'numeric',
                                        'bank_account' => 'numeric',
                                        'bank_name' => 'max:255'
                                    ],
        "order_validator" => [
                                        'name' => 'required_if:type,fiz|max:255',
                                        'company' => 'required_if:type,jur|max:255',
                                        'city' => 'required|max:255',
                                        'address' => 'required|max:255',
                                        'phone' => 'required|max:255',
                                        'qiwi_phone' => 'required_if:payment,qiwi|max:255',
                                        'email' => 'required|email|max:255',
                                        'post_index' => 'required|numeric',
                                        'inn' => 'required_if:type,jur|numeric',
                                        'bank_account' => 'required_if:type,jur|numeric',
                                        'bank_name' => 'required_if:type,jur|max:255',
                                        'payment' => 'required|max:16',
                                        'delivery_type' => 'required|max:255',
                                        'transport_company' => 'required_if:delivery_type,Транспортная компания|max:255',
                                        'comment' => 'max:255'
                                    ]

    ];

    public function get_validator(array $data, $type) {
        return Validator::make($data, $this->rules[$type], $this->validator_messages);
    }

    public function getCheckbox($var, $default=0) {
        return isset($var) ? 1: $default;
    }

    protected function doDateFromFormat ($date, $setToZero=True) {
        $format = "Y/m/d";
        if ($setToZero) return Carbon::createFromFormat($format, $date)->setTime(0,0,0);
        else return Carbon::createFromFormat($format, $date);
    }
    
    public function getPriceLevel() {
        $price_level = "price_retail_rub";
        if (Auth::user() && Auth::user()->price_level != "") $price_level = Auth::user()->price_level;
        return $price_level;
    }

    public function getMoney() {
        $money = "руб";
        if ( Auth::user() && Auth::user()->money != "") $money = Auth::user()->money;
        return $money;
    }

    public function updateCart($cook, $user) {
        $price_level = $user->price_level;
        $money = $user->money;
        $old_items = Cart::where('uid', $cook)->get();
        foreach ($old_items as $oi) {
            $g = Goods::find($oi->gid);
            $oi->price = $g[$price_level];
            $oi->uid = $user->id;
            $oi->money = $money;
            $oi->save();
        }
        $duplicates = array_pluck(Cart::select('id', DB::raw('count(id) as count'))->groupBy('gid')->having('count', '>', 1)->get(), 'id');
        Cart::whereIn('id', $duplicates)->delete();
    }
    public function getUID() {
        $suid = session('uid');
        $user = Auth::user();
        $uid = $suid;
        // if (!$suid and !$user) $uid = $this->v4();
        if (!$suid && !$user) $uid = uniqid($prefix="", $more_entropy = True);
        elseif ($user) {
            if ( $user->id != $suid) $this->updateCart($suid, $user);
            $uid = $user->id;
        }
        return $uid;
    }

    public function __construct() {
        $uid = $this->getUID();
        session(['uid' => $uid]);
        View::share('cart_length', Cart::where('uid', $uid)->count());
        View::share('cart_dict', Cart::getDict($uid));
        View::share('rubrics_dict', Rubric::getDict());
        View::share('relations_by_id', RubricRelation::getDict());
        View::share('relations_dict', RubricRelation::getRelationDict());
        View::share('money', $this->getMoney());
        View::share('price_level',$this->getPriceLevel());
        View::share('price_pack', array("$" => "price_pack_usd", "руб" => "price_pack_rub"));
        View::share('status_img', $this->status);
    }
}