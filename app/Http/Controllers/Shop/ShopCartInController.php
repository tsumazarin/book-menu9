<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ShopCartInController extends Controller
{
    //カートに入れる
    public function cartIn(Request $request)
    {
        $product_id = $request->productId;
        $product = Product::where('id', $product_id)->first();

        //カートを上書き
        if ($request->session()->get('carts') == true) {
          $carts = $request->session()->get('carts');
          $number = $request->session()->get('number');
          $selected_price = $request->session()->get('selected_price');
        }

        $carts[] = $product_id;
        $number[] = 1;
        $selected_price[] = $product->price;
        $request->session()->put([
            'carts' => $carts,
            'number' => $number,
            'selected_price' => $selected_price,
        ]);

        return view('shop.cartin', ['product' => $product]);
    }
}
