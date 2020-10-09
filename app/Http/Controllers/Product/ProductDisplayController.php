<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductDisplayController extends Controller
{
    //商品参照
    public function display(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $product_id = $request->session()->get('product_id');

        $product = Product::where('id', $product_id)->first();

        return view('product.display', [
            'login_name' => $login_name,
            'product' => $product,
        ]);
    }
}
