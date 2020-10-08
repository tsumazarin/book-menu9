<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShopRequest;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Sales_Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Stripe\Stripe;
use Stripe\Charge;
use \Stripe\Error\Card;


class ShopController extends Controller
{
    public function list(Request $request)
    {
        //ページング
        if (isset($request->page) && is_numeric($request->page)) {
          $page = $request->page;
        } else {
          $page = 1;
        }
        $start_page = 6 * ($page - 1);

        $counts = Product::all()->count();
        $max_page = ceil($counts / 6);

        $products = DB::table('products')
            ->offset($start_page)
            ->limit(6)
            ->get();
        //ページング処理終了

        return view('shop.list', [
            'page' => $page,
            'max_page' => $max_page,
            'products' => $products,
        ]);
    }

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


    public function form(Request $request)
    {
        //『ご購入手続きへ進む』から来たことを記録
        $request->session()->put('form', 'form');

        return view('shop.form');
    }

    public function formOk(ShopRequest $request)
    {
        $request->session()->put([
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'customer_postal' => $request->postal,
            'customer_address' => $request->address,
            'customer_tel' => $request->tel,
        ]);

        return redirect('/shop/form-check');
    }



    public function formCheck(Request $request)
    {
        $customer_name = $request->session()->get('customer_name');
        $customer_email = $request->session()->get('customer_email');
        $customer_postal = $request->session()->get('customer_postal');
        $customer_address = $request->session()->get('customer_address');
        $customer_tel = $request->session()->get('customer_tel');

        return view('shop.form-check', [
            'customer_name' => $customer_name,
            'customer_email' => $customer_email,
            'customer_postal' => $customer_postal,
            'customer_address' => $customer_address,
            'customer_tel' => $customer_tel,
        ]);
    }

    public function formCheckOk(Request $request)
    {
        $customer_name = $request->session()->get('customer_name');
        $customer_email = $request->session()->get('customer_email');
        $customer_postal = $request->session()->get('customer_postal');
        $customer_address = $request->session()->get('customer_address');
        $customer_tel = $request->session()->get('customer_tel');

        $carts[] = $request->session()->get('carts');
        $number[] = $request->session()->get('number');
        $selected_price[] = $request->session()->get('selected_price');
        $max = count($carts);

        if (isset($request->cash) == true || isset($request->card) == true) {

            $member_id = 0;
            //購入履歴IDの最後を取り出す
            if (Auth::check()){
                $user = Auth::user();
                $member_id = $user->id;
            }

            //salesにデータを入れる
            $sales_info = [
                'dateTime' => date('Y-m-d H:i:s'),
                'member_id' => $member_id,
                'name' => $customer_name,
                'email' => $customer_email,
                'postal' => $customer_postal,
                'address' => $customer_address,
                'tel' => $customer_tel,
            ];
            $sale = new Sale;
            unset($sales_info['_token']);
            $sale->timestamps = false;
            $sale->fill($sales_info)->save();

            //dat_sales_productにデータを入れる
            $sales_id[] = intval($sale->id);

            for ($i = 0; $i < $max; $i++) {
                $keys = ["sales_id", "product_id", "price", "quantity"];
                $values = [$sales_id, $carts[$i], $selected_price[$i], $number[$i]];
                $values = Arr::flatten($values);

                $sales_products_info = array_combine($keys, $values);

                DB::table('sales_products')->insert($sales_products_info);
                $keys = [];
                $values = [];
                $sales_products_info = [];
            }

            //代引きの場合
            if (isset($request->cash) == true) {
              $request->session()->put('pay', 'cash');
              return redirect('/shop/form-done');
            }

            //カード払いの場合
            if (isset($request->card) == true) {
              $request->session()->put('pay', 'card');
              return redirect('/shop/card');
            }
        }
    }

    public function formDone(Request $request)
    {
        $customer_name = $request->session()->get('customer_name');
        $customer_email = $request->session()->get('customer_email');
        $customer_postal = $request->session()->get('customer_postal');
        $customer_address = $request->session()->get('customer_address');
        $customer_tel = $request->session()->get('customer_tel');



        $carts[] = $request->session()->get('carts');
        $number[] = $request->session()->get('number');
        $number = Arr::flatten($number);
        $max = count($carts);
        $total = $request->session()->get('total');
        $pay = $request->session()->get('pay');

        $selected_name[] = $request->session()->get('selected_name');
        $selected_name = Arr::flatten($selected_name);
        $selected_price[] = $request->session()->get('selected_price');
        $selected_price = Arr::flatten($selected_price);

        $request->session()->flush();


        return view('shop.form-done', [
            'customer_name' => $customer_name,
            'customer_email' => $customer_email,
            'customer_postal' => $customer_postal,
            'customer_address' => $customer_address,
            'customer_tel' => $customer_tel,
            'number' => $number,
            'max' => $max,
            'total' => $total,
            'pay' => $pay,
            'selected_name' => $selected_name,
            'selected_price' => $selected_price,
        ]);
    }

    public function userFormCheck(Request $request)
    {
        //『会員限定かんたん注文』から来たことを記録
        $request->session()->put('form', 'userForm');

        $user = Auth::user();

        return view('/shop/userForm-check', ['user' => $user]);
    }

    public function userFormOk(Request $request)
    {
        $user = Auth::user();
        $customer_name = $user->name;
        $customer_email = $user->email;
        $customer_postal = $user->postal;
        $customer_address = $user->address;
        $customer_tel = $user->tel;

        $carts[] = $request->session()->get('carts');
        $number[] = $request->session()->get('number');
        $selected_price[] = $request->session()->get('selected_price');
        $max = count($carts);

        if (isset($request->cash) == true || isset($request->card) == true) {

            $member_id = 0;
            //購入履歴IDの最後を取り出す
            if (Auth::check()){
                $user = Auth::user();
                $member_id = $user->id;
            }

            //salesにデータを入れる
            $sales_info = [
                'dateTime' => date('Y-m-d H:i:s'),
                'member_id' => $member_id,
                'name' => $customer_name,
                'email' => $customer_email,
                'postal' => $customer_postal,
                'address' => $customer_address,
                'tel' => $customer_tel,
            ];
            $sale = new Sale;
            unset($sales_info['_token']);
            $sale->timestamps = false;
            $sale->fill($sales_info)->save();

            //dat_sales_productにデータを入れる
            $sales_id[] = intval($sale->id);

            for ($i = 0; $i < $max; $i++) {
                $keys = ["sales_id", "product_id", "price", "quantity"];
                $values = [$sales_id, $carts[$i], $selected_price[$i], $number[$i]];
                $values = Arr::flatten($values);

                $sales_products_info = array_combine($keys, $values);

                DB::table('sales_products')->insert($sales_products_info);
                $keys = [];
                $values = [];
                $sales_products_info = [];
            }

            //代引きの場合
            if (isset($request->cash) == true) {
              $request->session()->put('pay', 'cash');
              return redirect('/shop/userForm-done');
            }

            //カード払いの場合
            if (isset($request->card) == true) {
              $request->session()->put('pay', 'card');
              return redirect('/shop/card');
            }
        }
    }

    public function card(Request $request)
    {
        $total = $request->session()->get('total');

        return view('shop.card', ['total' => $total]);
    }

    public function cardOk(Request $request)
    {
        $total = $request->session()->get('total');

        Stripe::setApiKey(env('STRIPE_SECRET'));//シークレットキー

        $charge = Charge::create(array(
            'amount' => $total,
            'currency' => 'jpy',
            'source'=> request()->stripeToken,
        ));

        $form = $request->session()->get('form');
        //『かんたん注文』で購入
        if ($form == 'userForm') {
            return redirect('/shop/userForm-done');
        }

        //『かんたん注文』しないで購入
        if ($form == 'form') {
            return redirect('/shop/form-done');
        }
    }

    public function userFormDone(Request $request)
    {
        $user = Auth::user();
        $customer_name = $user->name;
        $customer_email = $user->email;
        $customer_postal = $user->postal;
        $customer_address = $user->address;
        $customer_tel = $user->tel;

        $carts[] = $request->session()->get('carts');
        $number[] = $request->session()->get('number');
        $number = Arr::flatten($number);
        $max = count($carts);
        $total = $request->session()->get('total');
        $pay = $request->session()->get('pay');

        $selected_name[] = $request->session()->get('selected_name');
        $selected_name = Arr::flatten($selected_name);
        $selected_price[] = $request->session()->get('selected_price');
        $selected_price = Arr::flatten($selected_price);

        $request->session()->flush();


        return view('shop.form-done', [
            'customer_name' => $customer_name,
            'customer_email' => $customer_email,
            'customer_postal' => $customer_postal,
            'customer_address' => $customer_address,
            'customer_tel' => $customer_tel,
            'number' => $number,
            'max' => $max,
            'total' => $total,
            'pay' => $pay,
            'selected_name' => $selected_name,
            'selected_price' => $selected_price,
        ]);
    }
}
