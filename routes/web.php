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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'MessagesController@index');
Route::resource('messages', 'MessagesController');//第一引数がテーブルの名前、第二はコントローラー
// HTTPS接続でアセット(CSSや画像など)を読み込むため
if (env('APP_ENV') === 'local') {
    URL::forceScheme('https');
};