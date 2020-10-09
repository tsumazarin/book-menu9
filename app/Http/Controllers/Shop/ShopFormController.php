<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ShopRequest;
use App\Models\Sale;
use App\Models\Sales_Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class ShopFormController extends Controller
{
    //注文フォーム
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

                $sales_product = new Sales_Product;
                unset($sales_products_info['_token']);
                $sales_product->timestamps = false;
                $sales_product->fill($sales_products_info)->save();
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
}
