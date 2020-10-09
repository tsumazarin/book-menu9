<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;


class ShopListController extends Controller
{
    //商品リスト
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
}
