<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StorageController extends SharedController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        return view('storage.storage');
    }
}
