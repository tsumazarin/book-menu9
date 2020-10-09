<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ShopDisplayController extends Controller
{
    //商品詳細
    public function display(Request $request)
    {

        $product_id = $request->productId;
        $product = Product::where('id', $product_id)->first();

        if ($request->session()->get('carts') == true) {
            $carts = $request->session()->get('carts');
        } else {
            $carts[] = 0;
        }

        if (in_array($product->id, $carts) == true){
            $msg = 'カートに入っています';
        } else {
            $msg = 'カートに入れる';
        }

        return view('shop.display', [
            'msg' => $msg,
            'product' => $product,
        ]);
    }
}
