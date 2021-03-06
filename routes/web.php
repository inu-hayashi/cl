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
use App\Coping;
use Illuminate\Http\Request;

//リスト表示 
// ('url','コントローラ名@メソッド名')
Route::get('/', 'CopingsController@index');

//登録処理
Route::post('copings','CopingsController@store');

//更新画面
Route::post('/copingsedit/{copings}','CopingsController@edit');

//更新処理
Route::post('/copings/update','CopingsController@update');

//削除
Route::delete('/coping/{coping}','CopingsController@destroy');

// 認証処理
Auth::routes();

// 新規ユーザー登録後に表示する画面
Route::get('/home', 'HomeController@index')->name('home');
