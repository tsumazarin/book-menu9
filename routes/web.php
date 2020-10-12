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
Route::namespace('App\Http\Controllers\Shop')->group(function () {
    Route::get('/', 'ShopListController@list');
    Route::get('/shop/list', 'ShopListController@list');

    Route::get('/shop/display', 'ShopDisplayController@display');

    Route::get('/shop/cartin', 'ShopCartInController@cartIn');

    Route::get('/shop/cartlook', 'ShopCartLookController@cartLook');
    Route::post('/shop/cartlook', 'ShopCartLookController@numberChange');

    Route::get('/shop/form', 'ShopFormController@form');
    Route::post('/shop/form', 'ShopFormController@formOk');

    Route::get('/shop/form-check', 'ShopFormController@formCheck');
    Route::post('/shop/form-check', 'ShopFormController@formCheckOk');

    Route::get('/shop/form-done', 'ShopFormController@formDone');

    Route::get('/shop/userForm-check', 'ShopUserFormController@userFormCheck');
    Route::post('/shop/userForm-check', 'ShopUserFormController@userFormOk');

    Route::get('/shop/userForm-done', 'ShopUserFormController@userFormDone');

    Route::get('/shop/card', 'ShopCardController@card');
    Route::post('/shop/card', 'ShopCardController@cardOk');
});



/*--- ユーザーログイン ---*/
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);


/*--- スタッフログイン ---*/
Route::namespace('App\Http\Controllers\StaffLogin')->group(function () {
    //スタッフログイン
    Route::get('/staff/login', 'StaffLoginController@login');
    Route::post('/staff/login', 'StaffLoginController@loginOk');

    //スタッフログアウト
    Route::get('/staff/logout', 'StaffLogoutController@logout');

    //管理者トップページ
    Route::get('/staff/top', 'StaffTopController@top');
});


/*--- スタッフ管理 ---*/
Route::namespace('App\Http\Controllers\Staff')->group(function () {
    //スタッフ一覧
    Route::get('/staff/list', 'StaffListController@list');
    Route::post('/staff/list', 'StaffListController@listSelect');

    //スタッフ追加
    Route::get('/staff/add', 'StaffAddController@add');
    Route::post('/staff/add', 'StaffAddController@addOk');

    Route::get('/staff/add-check', 'StaffAddController@addCheck');
    Route::post('/staff/add-check', 'StaffAddController@addCheckOk');

    Route::get('/staff/add-done', 'StaffAddController@addDone');

    //スタッフ参照
    Route::get('/staff/display', 'StaffDisplayController@display');

    //スタッフ修正
    Route::get('/staff/edit', 'StaffEditController@edit');
    Route::post('/staff/edit', 'StaffEditController@editOk');

    Route::get('/staff/edit-check', 'StaffEditController@editCheck');
    Route::post('/staff/edit-check', 'StaffEditController@editCheckOk');

    Route::get('/staff/edit-done', 'StaffEditController@editDone');

    //スタッフ削除
    Route::get('/staff/delete', 'StaffDeleteController@delete');
    Route::post('/staff/delete', 'StaffDeleteController@deleteOk');

    Route::get('/staff/delete-done', 'StaffDeleteController@deleteDone');
});


/*--- 商品管理 ---*/
Route::namespace('App\Http\Controllers\Product')->group(function () {
    //商品一覧
    Route::get('/product/list', 'ProductListController@list');
    Route::post('/product/list', 'ProductListController@listSelect');

    //商品追加
    Route::get('/product/add', 'ProductAddController@add');
    Route::post('/product/add', 'ProductAddController@addOk');

    Route::get('/product/add-check', 'ProductAddController@addCheck');
    Route::post('/product/add-check', 'Product\ProductAddController@addCheckOk');

    Route::get('/product/add-done', 'ProductAddController@addDone');

    //商品参照
    Route::get('/product/display', 'ProductDisplayController@display');

    //商品修正
    Route::get('/product/edit', 'ProductEditController@edit');
    Route::post('/product/edit', 'ProductEditController@editOk');

    Route::get('/product/edit-check', 'ProductEditController@editCheck');
    Route::post('/product/edit-check', 'ProductEditController@editCheckOk');

    Route::get('/product/edit-done', 'ProductEditController@editDone');

    //商品削除
    Route::get('/product/delete', 'ProductDeleteController@delete');
    Route::post('/product/delete', 'ProductDeleteController@deleteOk');

    Route::get('/product/delete-done', 'ProductDeleteController@deleteDone');
});
