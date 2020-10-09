<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ShopCartLookController extends Controller
{
    //カートを見る
    public function cartLook(Request $request)
    {
        if ($request->session()->get('carts') == true) {
            $carts = $request->session()->get('carts');
            $number = $request->session()->get('number');
            $max = count($carts);
            $request->session()->put('max', $max);
        }else{
            $max = 0;

            return view('shop.cartlook', ['max' => $max]);
        }

        //カートに入れた古本を取り出す
        foreach ($carts as $cart) {
            if ($cart == 0){
                continue;
            }

            $product = Product::where('id', $cart)->first();

            $selected_name[] = $product->title;
            $selected_price[] = $product->price;
            $selected_image[] = $product->image;

        }

        //総額を出す
        $total = 0;
        for ($i = 0; $i < $max; $i++) {
          $total += $selected_price[$i] * $number[$i];
        }
        $request->session()->put([
            'selected_name' => $selected_name,
            'selected_price' => $selected_price,
            'total' => $total,
        ]);

        return view('shop.cartlook', [
            'number' => $number,
            'total' => $total,
            'max' => $max,
            'selected_name' => $selected_name,
            'selected_price' => $selected_price,
            'selected_image' => $selected_image,
        ]);
    }

    //個数変更・商品取り消し
    public function numberChange(Request $request)
    {
        $max = $request->session()->get('max');
        $carts = $request->session()->get('carts');

        for ($i = 0; $i < $max; $i++) {
            $number[] = $request->input("number{$i}");
        }

        foreach ($number as $string) {
            if (!is_numeric($string)) {
              return redirect('/shop/cartLook');
            }

            if ($string < 1 || 10 < $string) {
              return redirect('/shop/cartLook');
            }
        }

        for ($i = $max; 0 <= $i; $i--) {
          if ($request->input("delete{$i}") == 'on') {
              array_splice($carts, $i, 1);
              array_splice($number, $i, 1);
          }
        }

        $request->session()->put([
            'carts' => $carts,
            'number' => $number,
        ]);

        return redirect('/shop/cartlook');
    }
}
