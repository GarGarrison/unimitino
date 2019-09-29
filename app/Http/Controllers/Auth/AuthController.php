<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
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
        return $this->get_validator($data, "new_user_validator");
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $data['id'] = $this->getUID();
        $data['password'] = bcrypt($data['password']);
        $data['type'] = $data['user_type'];
        return User::create($data);
        // return User::create([
        //     'id' => $this->getUID(),
        //     'type' => $data['user_type'],
        //     'name' => $data['name'],
        //     'city' => $data['city'],
        //     'company' => $data['company'],
        //     'post_index' => $data['post_index'],
        //     'address' => $data['address'],
        //     'phone' => $data['phone'],
        //     'bank_name' => $data['bank_name'],
        //     'bank_account' => $data['bank_account'],
        //     'inn' => $data['inn'],
        //     'password' => bcrypt($data['password']),
        //     'email' => $data['email']
        // ]);
    }

    public function logout(){
        auth()->logout();
        Session::flush();
        return redirect()->back();
    }
}
