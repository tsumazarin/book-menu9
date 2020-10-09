<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductListController extends Controller
{
    //商品一覧
    public function list(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $products = Product::all();

        return view('product.list', [
            'products' => $products,
            'login_name' => $login_name,
        ]);
    }

    public function listSelect(Request $request)
    {
        if (isset($request->add) == true) {
            //スタッフ追加へ
            return redirect('/product/add');
        }

        if (!empty($request->product_id)) {
            //スタッフコードをセッション
            $product_id = $request->product_id;
            $request->session()->put('product_id', $product_id);

            if (isset($request->display) == true) {
                //スタッフ参照へ
                return redirect('/product/display');
            }

            if (isset($request->edit) == true) {
                //スタッフ修正へ
                return redirect('/product/edit');
            }

            if (isset($request->delete) == true) {
                //スタッフ削除へ
                return redirect('/product/delete');
            }
        } else {
            return redirect('/product/list');
        }
    }
}
