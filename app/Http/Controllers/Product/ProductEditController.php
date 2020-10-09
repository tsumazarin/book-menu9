<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductEditController extends Controller
{
    //商品修正
    public function edit(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $product_id = $request->session()->get('product_id');

        $product = Product::where('id', $product_id)->first();

        //元のアップロード画像を削除
        $delete_image = str_replace('storage/', 'public/', $product->image);
        Storage::delete($delete_image);

        return view('product.edit', [
            'login_name' => $login_name,
            'product' => $product,
        ]);
    }

    public function editOk(ProductRequest $request)
    {
        $product_title = $request->title;
        $product_price = $request->price;
        $product_image = $request->image;

        //画像をアップロード
        $file = $request->file('image');
        $file = $request->image;
        $path = $request->image->path();
        $path = $request->image->store('public/books-images');
        $read_path = str_replace('public/', 'storage/', $path);

        $request->session()->put([
            'product_title' => $product_title,
            'product_price' => $product_price,
            'read_path' => $read_path,
        ]);

        return redirect('/product/edit-check');
    }

    //商品修正チェック
    public function editCheck(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $product_title = $request->session()->get('product_title');
        $product_price = $request->session()->get('product_price');
        $read_path = $request->session()->get('read_path');

        return view('product.edit-check', [
            'login_name' => $login_name,
            'product_title' => $product_title,
            'product_price' => $product_price,
            'read_path' => $read_path,
        ]);
    }

    public function editCheckOk(Request $request)
    {
        $product_id = $request->session()->get('product_id');

        $product_title = $request->session()->get('product_title');
        $product_price = $request->session()->get('product_price');
        $read_path = $request->session()->get('read_path');

        $product_info = [
            'title' => $product_title,
            'price' => $product_price,
            'image' => $read_path,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $product = Product::find($product_id);
        unset($product_info['_token']);
        $product->fill($product_info)->save();

        return redirect('/product/edit-done');
    }

    //商品修正完了
    public function editDone(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $product_title = $request->session()->get('product_title');

        return view('product.edit-done', [
            'login_name' => $login_name,
            'product_title' => $product_title,
        ]);
    }
}
