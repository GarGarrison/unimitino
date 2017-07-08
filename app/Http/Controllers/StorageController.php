<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Order;
use App\User;
use DB;
class StorageController extends SharedController
{   
    public $delay_time = 15 * 60;

    public function getTimeDelta(){
        return Carbon::now()->addSeconds($this->delay_time);//->timestamp;
    }

    public function getLastTakeplace($order){
        $takeplace = $order->takeplace;
        if ($takeplace == "") {
            $last = Order::where('uid', $order->uid)
                ->where('status', '<>', 6)
                ->where('takeplace', '<>', "")
                ->orderBy('orders.created_at', 'desc')->first();
            if ($last) {
                $takeplace = $last->takeplace;
                
            }
        }
        return $takeplace;
    }

    public function updateOrder($join, $takeplace=false) {
        if ($join) {
            if (!$takeplace) $takeplace = $this->getLastTakeplace($join);
            $order = Order::find($join->oid);
            $order->update([
                "status" => 2,
                "takeplace" => $takeplace
            ]);
            $join->takeplace = $takeplace;
        }
    }

    public function getStorageOrderTime($user) {
        $order = DB::table('orders')
            ->where(function($query){
                $query->where('status', '2');
                $query->where('orders.updated_at', '<', $this->getTimeDelta());
                $query->orWhere('status', 0);
            })
            ->leftJoin('goods', 'orders.gid', '=', 'goods.id')
            ->select('orders.id as oid', 'orders.*', 'goods.*')
            //->where($user->storage, '<>', 0)
            ->orderBy('orders.created_at', 'desc')->first();
        //$this->updateOrder($order);
        return $order;
    }

    public function getStorageOrderNoTime($user) {
        $order = DB::table('orders')
            ->where('status', 0)
            ->leftJoin('goods', 'orders.gid', '=', 'goods.id')
            ->select('orders.id as oid', 'orders.*', 'goods.*')
            //->where($user->storage, '<>', 0)
            ->orderBy('orders.created_at', 'desc')->first();
        //$this->updateOrder($order);
        return $order;
    }

    public function getStorageOrder($user) {
        $client = "";
        $order = $this->getStorageOrderTime($user);
        if ($order) $client = User::find($order->uid);
        return array($order, $client);
    }
    /* WEB PART*/
    public function reloadstorage() {
        $user = Auth::user();
        list($order, $client) = $this->getStorageOrder($user);
        $this->updateOrder($order);
        $data = ["order" => $order, "client"=>$client, "user" => $user];
        return view('storage.storage_table', $data);
    }

    public function checkneworders(Request $request) {
        $user = Auth::user();
        list($order, $client) = $this->getStorageOrder($user);
        if ($order) return "1";
        else return "0";
    }

    public function changedonecount(Request $request) {
        $order = Order::find($request['oid']);
        $order->update(["countdone" => $request['count']]);
    }

    public function changetakeplace(Request $request) {
        $order = Order::find($request['oid']);
        $order->update(["takeplace" => $request['place']]);
    }

    public function changestatus(Request $request) {
        $user = Auth::user();
        $order = Order::find($request['oid']);
        $clientId = $order->uid;
        $nextClient = "";
        $order->update([
            "takeplace" => $request["takeplace"],
            "status" => $request["status"],
            "countdone" => $request["countdone"],
            "storage_user" => $user->id
        ]);
        // следующий заказ от того же клиента
        // В ОРИГИНАЛЕ: ->where($user->storage, '<>', 0) Для офлайн и онлайн количества.
        // пока не понятно что там
        $nextOrder = DB::table('orders')
            ->where('uid', $clientId)
            ->where(function($query){
                $query->where('status', '2');
                $query->where('orders.updated_at', '<', $this->getTimeDelta());
                $query->orWhere('status', 0);
            })
            ->leftJoin('goods', 'orders.gid', '=', 'goods.id')
            ->select('orders.id as oid', 'orders.*', 'goods.*')
            //->where($user->storage, '<>', 0)
            ->orderBy('orders.created_at', 'desc')->first();

        // если таких нет, ищем любой другой
        // В ОРИГИНАЛЕ: ->where($user->storage, '<>', 0) Для офлайн и онлайн количества.
        // пока не понятно что там
        if (!$nextOrder) {
            $nextOrder = DB::table('orders')
                ->where(function($query){
                    $query->where('status', '2');
                    $query->where('orders.updated_at', '<', $this->getTimeDelta());
                    $query->orWhere('status', 0);
                })
                ->leftJoin('goods', 'orders.gid', '=', 'goods.id')
                ->select('orders.id as oid', 'orders.*', 'goods.*')
                //->where($user->storage, '<>', 0)
                ->orderBy('orders.created_at', 'desc')->first();
        }
        if ($nextOrder) {
            $nextClient = User::find($nextOrder->uid);
            $takeplace = $nextOrder->takeplace;
            if ( $takeplace == "" && $clientId == $nextClient->id) $takeplace = $request["takeplace"];
            $this->updateOrder($nextOrder, $takeplace);
        }
        $data = ["order" => $nextOrder, "client"=>$nextClient, "user" => $user];
        return view('storage.storage_table', $data);
    }
}
