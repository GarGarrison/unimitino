<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\SharedController;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class PasswordController extends SharedController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware());
        parent::__construct();
    }

    protected function getResetValidationRules()
    {
        return $this->rules["reset_password_validator"];
    }

    protected function getResetValidationMessages()
    {
        return $this->validator_messages;
    }

    protected function getEmailSubject()
    {
        return property_exists($this, 'subject') ? $this->subject : 'Сброс пароля на сайте Унисервис';
    }

    protected function getSendResetLinkEmailFailureResponse($response)
    {
        return redirect()->back()->with('status', trans($response));
    }

    protected function getResetFailureResponse(Request $request, $response)
    {
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['common_error' => trans($response)]);
    }
}