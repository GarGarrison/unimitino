<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Socialite;
use App\User;

class SocialController extends Controller
{
    public function login($provider) {
        return Socialite::with($provider)->redirect();
    }
    public function callback($provider) {
        $user = Socialite::driver($provider)->user();
        $name = $user->getName();
        $email = $user->getEmail();
        $login = "";
        $check_user = User::whereEmail($email)->first();
        if ($check_user) $login = $check_user;
        else {
            $login = new User;
            $login->name = $name;
            $login->email = $email;
        }
        Auth::login($login, true);
        return redirect()->intended('/');
    }
}
