<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use VK\Client\VKApiClient;
use VK\OAuth\Scopes\VKOAuthGroupScope;
use Socialite;
use App\User;

class SocialController extends Controller
{
    public function login($provider) {
        return Socialite::with($provider)->redirect();
    }
    public function admin_sync($provider) {
        return Socialite::with($provider)->with(['state' => 'admin'])->scopes([VKOAuthGroupScope::MESSAGES])->redirect();
    }
    public function callback($provider, Request $request) {
        $user = Socialite::driver($provider)->stateless()->user();
        $state = $request['state'];
        if ($state == "admin") {
            $access_token = $user->token;
            $vk = new VKApiClient();
            $response = $vk->wall()->post($access_token, array( 
                'owner_id' => -133309598, 
                "from_group" => 1,
                "message" => "ololo",
            ));
            dd($response);
            // group_id = "133309598"
            return redirect()->back();
        }
        else {
            $name = $user->getName();
            $email = $user->getEmail();
            if (!$email) $email = $user->accessTokenResponseBody['email'];
            $login = "";
            $check_user = User::whereEmail($email)->first();
            if ($check_user) $login = $check_user;
            else {
                $login = new User;
                $login->name = $name;
                $login->email = $email;
                $login->type = "fiz";
                $login->role = "user";
            }
            Auth::login($login, true);
            return redirect()->intended('/');
        }
    }
}
