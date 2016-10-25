<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $guarded = [
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'type',
    ];

    public function isAdmin() {
        return $this->type == "admin";
    }
    public function isStorage() {
        return $this->type == "storage";
    }
    public function isUser() {
        return $this->type == "user";
    }
}
