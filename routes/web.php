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
Route::get('/', 'App\Http\Controllers\Shop\ShopListController@list');
Route::get('/shop/list', 'App\Http\Controllers\Shop\ShopListController@list');

Route::get('/shop/display', 'App\Http\Controllers\Shop\ShopDisplayController@display');

Route::get('/shop/cartin', 'App\Http\Controllers\Shop\ShopCartInController@cartIn');

Route::get('/shop/cartlook', 'App\Http\Controllers\Shop\ShopCartLookController@cartLook');
Route::post('/shop/cartlook', 'App\Http\Controllers\Shop\ShopCartLookController@numberChange');

Route::get('/shop/form', 'App\Http\Controllers\Shop\ShopFormController@form');
Route::post('/shop/form', 'App\Http\Controllers\Shop\ShopFormController@formOk');

Route::get('/shop/form-check', 'App\Http\Controllers\Shop\ShopFormController@formCheck');
Route::post('/shop/form-check', 'App\Http\Controllers\Shop\ShopFormController@formCheckOk');

Route::get('/shop/form-done', 'App\Http\Controllers\Shop\ShopFormController@formDone');

Route::get('/shop/userForm-check', 'App\Http\Controllers\Shop\ShopUserFormController@userFormCheck');
Route::post('/shop/userForm-check', 'App\Http\Controllers\Shop\ShopUserFormController@userFormOk');

Route::get('/shop/userForm-done', 'App\Http\Controllers\Shop\ShopUserFormController@userFormDone');

Route::get('/shop/card', 'App\Http\Controllers\Shop\ShopCardController@card');
Route::post('/shop/card', 'App\Http\Controllers\Shop\ShopCardController@cardOk');


/*--- ユーザーログイン ---*/
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);


/*--- スタッフログイン ---*/
//スタッフログイン
Route::get('/staff/login', 'App\Http\Controllers\StaffLogin\StaffLoginController@login');
Route::post('/staff/login', 'App\Http\Controllers\StaffLogin\StaffLoginController@loginOk');

//スタッフログアウト
Route::get('/staff/logout', 'App\Http\Controllers\StaffLogin\StaffLogoutController@logout');

//管理者トップページ
Route::get('/staff/top', 'App\Http\Controllers\StaffLogin\StaffTopController@top');

/*--- スタッフ管理 ---*/
//スタッフ一覧
Route::get('/staff/list', 'App\Http\Controllers\Staff\StaffListController@list');
Route::post('/staff/list', 'App\Http\Controllers\Staff\StaffListController@listSelect');

//スタッフ追加
Route::get('/staff/add', 'App\Http\Controllers\Staff\StaffAddController@add');
Route::post('/staff/add', 'App\Http\Controllers\Staff\StaffAddController@addOk');

Route::get('/staff/add-check', 'App\Http\Controllers\Staff\StaffAddController@addCheck');
Route::post('/staff/add-check', 'App\Http\Controllers\Staff\StaffAddController@addCheckOk');

Route::get('/staff/add-done', 'App\Http\Controllers\Staff\StaffAddController@addDone');

//スタッフ参照
Route::get('/staff/display', 'App\Http\Controllers\Staff\StaffDisplayController@display');

//スタッフ修正
Route::get('/staff/edit', 'App\Http\Controllers\Staff\StaffEditController@edit');
Route::post('/staff/edit', 'App\Http\Controllers\Staff\StaffEditController@editOk');

Route::get('/staff/edit-check', 'App\Http\Controllers\Staff\StaffEditController@editCheck');
Route::post('/staff/edit-check', 'App\Http\Controllers\Staff\StaffEditController@editCheckOk');

Route::get('/staff/edit-done', 'App\Http\Controllers\Staff\StaffEditController@editDone');

//スタッフ削除
Route::get('/staff/delete', 'App\Http\Controllers\Staff\StaffDeleteController@delete');
Route::post('/staff/delete', 'App\Http\Controllers\Staff\StaffDeleteController@deleteOk');

Route::get('/staff/delete-done', 'App\Http\Controllers\Staff\StaffDeleteController@deleteDone');

/*--- 商品管理 ---*/
//商品一覧
Route::get('/product/list', 'App\Http\Controllers\Product\ProductListController@list');
Route::post('/product/list', 'App\Http\Controllers\Product\ProductListController@listSelect');

//商品追加
Route::get('/product/add', 'App\Http\Controllers\Product\ProductAddController@add');
Route::post('/product/add', 'App\Http\Controllers\Product\ProductAddController@addOk');

Route::get('/product/add-check', 'App\Http\Controllers\Product\ProductAddController@addCheck');
Route::post('/product/add-check', 'App\Http\Controllers\Product\ProductAddController@addCheckOk');

Route::get('/product/add-done', 'App\Http\Controllers\Product\ProductAddController@addDone');

//商品参照
Route::get('/product/display', 'App\Http\Controllers\Product\ProductDisplayController@display');

//商品修正
Route::get('/product/edit', 'App\Http\Controllers\Product\ProductEditController@edit');
Route::post('/product/edit', 'App\Http\Controllers\Product\ProductEditController@editOk');

Route::get('/product/edit-check', 'App\Http\Controllers\Product\ProductEditController@editCheck');
Route::post('/product/edit-check', 'App\Http\Controllers\Product\ProductEditController@editCheckOk');

Route::get('/product/edit-done', 'App\Http\Controllers\Product\ProductEditController@editDone');

//商品削除
Route::get('/product/delete', 'App\Http\Controllers\Product\ProductDeleteController@delete');
Route::post('/product/delete', 'App\Http\Controllers\Product\ProductDeleteController@deleteOk');

Route::get('/product/delete-done', 'App\Http\Controllers\Product\ProductDeleteController@deleteDone');
