<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $incrementing = false;
    
    // protected $guarded = ['remember_token',];

    protected $fillable = [
        "name",
        "city",
        "company",
        "post_index",
        "address",
        "phone",
        "bank_name",
        "bank_account",
        "inn",
        "email",
        "password",
        "type",
        "role",
        "money",
        "price_level",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin() {
        return $this->role == "admin";
    }
    public function isStorage() {
        return $this->role == "storage";
    }
    public function isUser() {
        return $this->role == "user";
    }
}
