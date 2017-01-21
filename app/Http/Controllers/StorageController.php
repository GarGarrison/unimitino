<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use DB;
class StorageController extends SharedController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        return view('storage.storage');
    }

    public function reload() {
        $order = DB::table('orders')
                ->leftJoin('goods', 'goods.id', '=', 'orders.gid')
                ->where('status', '0')
                ->orderBy('created_at')->first();
        
        return view('storage.storage', ["order" => $order]);
    }

    public function checknew() {
        return view('storage.storage');
    }
}
