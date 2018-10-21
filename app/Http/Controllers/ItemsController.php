<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Item;

class ItemsController extends Controller
{
    public function create()
    {
        $keyword = request()->keyword;//フォームから送信される検索ワードを取得
        $items = [];//$items をカラの配列として初期化
        if ($keyword) {//検索ワード が与えられていると楽天APIを使用して検索を行う
            $client = new \RakutenRws_Client();//クライアントを作成
            $client->setApplicationId(env('RAKUTEN_APPLICATION_ID'));//アプリIDを設定

            $rws_response = $client->execute('IchibaItemSearch', [
                'keyword' => $keyword,//検索ワードを設定
                'imageFlag' => 1,//画像があるもののみに絞り込み
                'hits' => 20,//20件検索
            ]);

            // 扱い易いように Item としてインスタンスを作成する（保存はしない）
            foreach ($rws_response->getData()['Items'] as $rws_item) {
                $item = new Item();
                $item->code = $rws_item['Item']['itemCode'];
                $item->name = $rws_item['Item']['itemName'];
                $item->url = $rws_item['Item']['itemUrl'];
                $item->image_url = str_replace('?_ex=128x128', '', $rws_item['Item']['mediumImageUrls'][0]['imageUrl']);
                //str_replace は文字列置換用の関数で、第三引数から第一引数を見つけ出して、第二引数に置換する
                //今回、第ニ引数に '' とカラ文字を入れているので、見つけたら削除される⇒結果小さすぎる画像を無理矢理に元画像で取得している
                $items[] = $item;//予め初期化していたカラの配列である $items に追加。上書きではない！
            }
        }

        return view('items.create', [
            'keyword' => $keyword,
            'items' => $items,
        ]);
    }
}
