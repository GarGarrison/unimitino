<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends SharedController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        return view('admin.admin');
    }
    public function view_rubric() {
        return view('admin.rubric');
    }
    public function view_news() {
        return view('admin.news');
    }
    public function view_users() {
        return view('admin.users');
    }
    public function view_goods() {
        return view('admin.goods');
    }
}
