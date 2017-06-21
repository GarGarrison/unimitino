<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use Validator;
use Session;
use App\Http\Controllers\SharedController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends SharedController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'getLogout']]);
        parent::__construct();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:3|confirmed',
            'name' => 'max:255',
            'post_index' => 'integer',
            'inn' => 'integer',
            'bank_account' => 'integer'
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'type' => $data['user_type'],
            'name' => $data['name'],
            'city' => $data['city'],
            'company' => $data['company'],
            'post_index' => $data['post_index'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'bank_name' => $data['bank_name'],
            'bank_account' => $data['bank_account'],
            'inn' => $data['inn'],
            #'password' => bcrypt($data['password']),
            'email' => $data['email']
        ]);
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => bcrypt($data['password']),
        //     'type' => $data['user_type']
        // ]);
    }

    public function logout(){
        auth()->logout();
        Session::flush();
        return redirect()->back();
    }
}
