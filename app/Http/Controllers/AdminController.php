<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    public function index() {
        return view('admin.admin');
    }
    public function view_rubric() {
        return view('admin.rubric');
    }
    public function view_news() {
        return view('admin.news');
    }
}
