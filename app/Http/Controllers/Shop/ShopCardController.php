<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use \Stripe\Error\Card;

class ShopCardController extends Controller
{
    //カード払い
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
}
