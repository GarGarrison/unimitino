<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Goods;
use App\Order;
use App\News;
use DB;

class ScriptsController extends SharedController
{
    public function backoffice(Request $request) {
        $req = $request->all();
        try {
                if ($req['action']=='updategoodscount') {
                    $goods = Goods::find($req['id']);
                    $goods->update([
                        "offlinecount" => $req['offlinecount'],
                        "onlinecount" => $req['onlinecount']
                    ]);
                    echo 'ok';
                }

                if ($req['action']=='updategoodsdata') {
                    $goods = Goods::find($req['id']);
                    $goods->update([
                        "address" => $req['address'],
                        "typonominal" => $req['typonominal'],
                        "mark" => $req['mark'],
                        "producer" => $req['producer'],
                        "case" => $req['case'],
                        "price_retail_usd" => $req['price_retail_usd'],
                        "price_retail_rub" => $req['price_retail_rub'],
                        "price_minitrade_usd" => $req['price_minitrade_usd'],
                        "price_minitrade_rub" => $req['price_minitrade_rub'],
                        "price_trade_usd" => $req['price_trade_usd'],
                        "price_trade_rub" => $req['price_trade_rub'],
                        "price_pack_usd" => $req['price_pack_usd'],
                        "price_pack_rub" => $req['price_pack_rub'],
                        "packcount" => $req['packcount']
                    ]);
                    echo 'ok';
                }

                if ($req['action']=='updategoodsprice') {
                    $goods = Goods::find($req['id']);
                    $goods->update([
                        "price_retail_usd" => $req['price_retail_usd'],
                        "price_retail_rub" => $req['price_retail_rub'],
                        "price_minitrade_usd" => $req['price_minitrade_usd'],
                        "price_minitrade_rub" => $req['price_minitrade_rub'],
                        "price_trade_usd" => $req['price_trade_usd'],
                        "price_trade_rub" => $req['price_trade_rub'],
                        "price_pack_usd" => $req['price_pack_usd'],
                        "price_pack_rub" => $req['price_pack_rub']
                    ]);
                    echo 'ok';
                }

                if ($req['action']=='insertgoods') {
                    Goods::create([
                        "address" => $req['address'],
                        "num" => $req['num'],
                        "offlinecount" => $req['offlinecount'],
                        "onlinecount" => $req['onlinecount'],
                        "typonominal" => $req['typonominal'],
                        "mark" => $req['mark'],
                        "producer" => $req['producer'],
                        "case" => $req['case'],
                        "price_retail_usd" => $req['price_retail_usd'],
                        "price_retail_rub" => $req['price_retail_rub'],
                        "price_minitrade_usd" => $req['price_minitrade_usd'],
                        "price_minitrade_rub" => $req['price_minitrade_rub'],
                        "price_trade_usd" => $req['price_trade_usd'],
                        "price_trade_rub" => $req['price_trade_rub'],
                        "price_pack_usd" => $req['price_pack_usd'],
                        "price_pack_rub" => $req['price_pack_rub'],
                        "packcount" => $req['packcount']
                    ]);
                    echo 'ok';
                }

                if ($req['action']=='deletegoods') {
                    Goods::destroy($req['id']);
                    echo 'ok';
                }

                if ($req['action']==='getmaxorder') {
                    echo DB::table('orders')->max('id');
                }

                if ($req['action']==='getorder') {
                    $order = Order::find($req['id']);
                    //$order = ORM::for_table('order')->select_expr("*, DATE_FORMAT(`datetime`, '%p') as dateformat")->where('id', $req['id'])->find_array();
                    echo json_encode($order);
                }

                if ($req['action']==='setorderstatus') {
                    $order = Order::find($req['id']);
                    $order->update([
                        "status" => $req['status'];
                        "billid" => $req['billid'];
                        "payment_status" => $req['payment_status'];
                    ]);
                    //$order->status = $req['status'];
                    //$order->billid = $req['billid'];
                    //if (isset($req['countdone'])) $order->countdone = $req['countdone'];
                    //$order->save();
                    echo 'ok';
                }

                if ($req['action']==='insertnews') {
                    News::create([
                        'title' => $req['title'],
                        'annotation' => $req['annotation'],
                        'text' => $req['text'],
                        'news_date' => $this->doDateFromFormat($req['news_date_submit']),
                        'public_date' => $this->doDateFromFormat($req['public_date_submit']),
                        'unpublic_date' => $this->doDateFromFormat($req['unpublic_date_submit'])
                    ]);
                    echo 'ok';
                }
                if ($req['action']==='updatenews') {
                    $news = News::find($req['id']);
                    $news->update([
                        'title' => $req['title'],
                        'annotation' => $req['annotation'],
                        'text' => $req['text'],
                        'news_date' => $this->doDateFromFormat($req['news_date_submit']),
                        'public_date' => $this->doDateFromFormat($req['public_date_submit']),
                        'unpublic_date' => $this->doDateFromFormat($req['unpublic_date_submit'])
                    ]);
                    echo 'ok';
                }

        } catch (Exception $e) {
            echo "Database error: \r\n" . $e->getMessage();
            exit;
        }

    }
}
