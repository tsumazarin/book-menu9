<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //商品一覧
    public function list(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $products = Product::all();

        return view('product.list', [
            'products' => $products,
            'login_name' => $login_name,
        ]);
    }

    public function listSelect(Request $request)
    {
        if (isset($request->add) == true) {
            //スタッフ追加へ
            return redirect('/product/add');
        }

        if (!empty($request->product_id)) {
            //スタッフコードをセッション
            $product_id = $request->product_id;
            $request->session()->put('product_id', $product_id);

            if (isset($request->display) == true) {
                //スタッフ参照へ
                return redirect('/product/display');
            }

            if (isset($request->edit) == true) {
                //スタッフ修正へ
                return redirect('/product/edit');
            }

            if (isset($request->delete) == true) {
                //スタッフ削除へ
                return redirect('/product/delete');
            }
        } else {
            return redirect('/product/list');
        }
    }

    //商品追加
    public function add(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        return view('product.add', ['login_name' => $login_name]);
    }

    public function addOk(ProductRequest $request)
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

        return redirect('/product/add-check');
    }

    //商品追加チェック
    public function addCheck(Request $request)
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

        return view('product.add-check', [
            'login_name' => $login_name,
            'product_title' => $product_title,
            'product_price' => $product_price,
            'read_path' => $read_path,
        ]);
    }

    public function addCheckOk(Request $request)
    {
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
        $product = new Product;
        unset($product_info['_token']);
        $product->fill($product_info)->save();

        return redirect('/product/add-done');
    }

    //商品追加完了
    public function addDone(Request $request)
    {
        //ログインチェック
        $login_check = $request->session()->get('login_check');
        if (isset($login_check) == false) {
            return redirect('/staff/login');
        }
        $login_name = $request->session()->get('login_name');

        $product_title = $request->session()->get('product_title');

        return view('product.add-done', [
            'login_name' => $login_name,
            'product_title' => $product_title,
        ]);
    }


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
