<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'WelcomeController@index');

//ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');//views/auth/register.blade.phpを表示する
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
//nameメソッド｢->name('●●');｣は名前つきルー、特定のルートへのURLを生成したり、リダイレクトしたりする場合に便利なものです。

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ランキング
Route::get('ranking/want', 'RankingController@want')->name('ranking.want');
Route::get('ranking/have', 'RankingController@have')->name('ranking.have');

//ログイン認証付きのルーティング
Route::group(['middleware' => 'auth'], function () { //ルーティングのグループを作成
              //['middleware' => ['auth']]ミドルウェアでこのグループに書かれたルーティングは必ずログイン認証を確認させる
    Route::resource('items', 'ItemsController', ['only' => ['create', 'show']]); //['only' => ['create']]実装するアクションを絞り込む
    Route::post('want', 'ItemUserController@want')->name('item_user.want');
    Route::delete('want', 'ItemUserController@dont_want')->name('item_user.dont_want');
    Route::post('have', 'ItemUserController@have')->name('item_user.have');
    Route::delete('have', 'ItemUserController@dont_have')->name('item_user.dont_have');
    Route::resource('users', 'UsersController', ['only' => ['show']]);
});