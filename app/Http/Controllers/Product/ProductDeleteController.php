<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductDeleteController extends Controller
{
    //商品削除
    public function delete(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $product_id = $request->session()->get('product_id');

        $product = Product::where('id', $product_id)->first();

        return view('product.delete', [
            'login_name' => $login_name,
            'product' => $product,
        ]);
    }

    public function deleteOk(Request $request)
    {
        $product_id = $request->session()->get('product_id');

        $product = Product::where('id', $product_id)->first();
        $request->session()->put('product_title', $product->title);

        //元のアップロード画像を削除
        $delete_image = str_replace('storage/', 'public/', $product->image);
        Storage::delete($delete_image);

        $product = Product::find($product_id)->delete();

        return redirect('/product/delete-done');
    }

    public function deleteDone(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $product_title = $request->session()->get('product_title');


        return view('product.delete-done', [
            'login_name' => $login_name,
            'product_title' => $product_title,
        ]);
    }
}
