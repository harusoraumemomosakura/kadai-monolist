<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;

class RankingController extends Controller
{
     public function want()
    {
        $items = \DB::table('item_user')//Want の中間テーブルである item_user を指定
        ->join('items', 'item_user.item_id', '=', 'items.id')//items テーブルを item_user テーブルと結合
        ->select('items.*', \DB::raw('COUNT(*) as count'))//取得したいテーブルのカラムを選択しています。 COUNT(*) AS count で集計しています。また、 AS を使って COUNT 計算によって一時的に出現するカラムに、 count という名前をつけています。
        ->where('type', 'want')//Have はここでは不要なので限定しています。
        ->groupBy('items.id', 'items.code', 'items.name', 'items.url', 'items.image_url','items.created_at', 'items.updated_at')//itemsテーブルにあるカラムを全て使ってグループ化
        ->orderBy('count', 'DESC')//count の大きい順での並べ替え
        ->take(10)//ランキングは10個まで
        ->get();//ランキングデータを取得

        return view('ranking.want', [
            'items' => $items,
        ]);
    }
    
     public function have()
    {
        $items = \DB::table('item_user')->join('items', 'item_user.item_id', '=', 'items.id')->select('items.*', \DB::raw('COUNT(*) as count'))->where('type', 'have')->groupBy('items.id', 'items.code', 'items.name', 'items.url', 'items.image_url','items.created_at', 'items.updated_at')->orderBy('count', 'DESC')->take(10)->get();

        return view('ranking.have', [
            'items' => $items,
        ]);
    }
}
