<?php

use Illuminate\Support\Facades\Route;

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


/*--- メニュー ---*/
Route::get('/', 'App\Http\Controllers\ShopController@list');
Route::get('/shop/list', 'App\Http\Controllers\ShopController@list');

Route::get('/shop/display', 'App\Http\Controllers\ShopController@display');

Route::get('/shop/cartin', 'App\Http\Controllers\ShopController@cartIn');

Route::get('/shop/cartlook', 'App\Http\Controllers\ShopController@cartLook');
Route::post('/shop/cartlook', 'App\Http\Controllers\ShopController@numberChange');

Route::get('/shop/form', 'App\Http\Controllers\ShopController@form');
Route::post('/shop/form', 'App\Http\Controllers\ShopController@formOk');

Route::get('/shop/form-check', 'App\Http\Controllers\ShopController@formCheck');
Route::post('/shop/form-check', 'App\Http\Controllers\ShopController@formCheckOk');

Route::get('/shop/form-done', 'App\Http\Controllers\ShopController@formDone');

Route::get('/shop/userForm-check', 'App\Http\Controllers\ShopController@userFormCheck');
Route::post('/shop/userForm-check', 'App\Http\Controllers\ShopController@userFormOk');

Route::get('/shop/card', 'App\Http\Controllers\ShopController@card');
Route::post('/shop/card', 'App\Http\Controllers\ShopController@cardOk');

Route::get('/shop/userForm-done', 'App\Http\Controllers\ShopController@userFormDone');




/*--- ユーザーログイン ---*/
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);


/*--- スタッフログイン ---*/
//スタッフログイン
Route::get('/staff/login', 'App\Http\Controllers\StaffLoginController@login');
Route::post('/staff/login', 'App\Http\Controllers\StaffLoginController@loginOk');

//スタッフログアウト
Route::get('/staff/logout', 'App\Http\Controllers\StaffLoginController@logout');

//管理者トップページ
Route::get('/staff/top', 'App\Http\Controllers\StaffLoginController@top');

/*--- スタッフ管理 ---*/
//スタッフ一覧
Route::get('/staff/list', 'App\Http\Controllers\StaffController@list');
Route::post('/staff/list', 'App\Http\Controllers\StaffController@listSelect');

//スタッフ追加
Route::get('/staff/add', 'App\Http\Controllers\StaffController@add');
Route::post('/staff/add', 'App\Http\Controllers\StaffController@addOk');

Route::get('/staff/add-check', 'App\Http\Controllers\StaffController@addCheck');
Route::post('/staff/add-check', 'App\Http\Controllers\StaffController@addCheckOk');

Route::get('/staff/add-done', 'App\Http\Controllers\StaffController@addDone');

//スタッフ参照
Route::get('/staff/display', 'App\Http\Controllers\StaffController@display');

//スタッフ修正
Route::get('/staff/edit', 'App\Http\Controllers\StaffController@edit');
Route::post('/staff/edit', 'App\Http\Controllers\StaffController@editOk');

Route::get('/staff/edit-check', 'App\Http\Controllers\StaffController@editCheck');
Route::post('/staff/edit-check', 'App\Http\Controllers\StaffController@editCheckOk');

Route::get('/staff/edit-done', 'App\Http\Controllers\StaffController@editDone');

//スタッフ削除
Route::get('/staff/delete', 'App\Http\Controllers\StaffController@delete');
Route::post('/staff/delete', 'App\Http\Controllers\StaffController@deleteOk');

Route::get('/staff/delete-done', 'App\Http\Controllers\StaffController@deleteDone');

/*--- 商品管理 ---*/
//商品一覧
Route::get('/product/list', 'App\Http\Controllers\ProductController@list');
Route::post('/product/list', 'App\Http\Controllers\ProductController@listSelect');

//商品追加
Route::get('/product/add', 'App\Http\Controllers\ProductController@add');
Route::post('/product/add', 'App\Http\Controllers\ProductController@addOk');

Route::get('/product/add-check', 'App\Http\Controllers\ProductController@addCheck');
Route::post('/product/add-check', 'App\Http\Controllers\ProductController@addCheckOk');

Route::get('/product/add-done', 'App\Http\Controllers\ProductController@addDone');

//商品参照
Route::get('/product/display', 'App\Http\Controllers\ProductController@display');

//商品修正
Route::get('/product/edit', 'App\Http\Controllers\ProductController@edit');
Route::post('/product/edit', 'App\Http\Controllers\ProductController@editOk');

Route::get('/product/edit-check', 'App\Http\Controllers\ProductController@editCheck');
Route::post('/product/edit-check', 'App\Http\Controllers\ProductController@editCheckOk');

Route::get('/product/edit-done', 'App\Http\Controllers\ProductController@editDone');

//商品削除
Route::get('/product/delete', 'App\Http\Controllers\ProductController@delete');
Route::post('/product/delete', 'App\Http\Controllers\ProductController@deleteOk');

Route::get('/product/delete-done', 'App\Http\Controllers\ProductController@deleteDone');
