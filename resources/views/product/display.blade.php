@extends('layouts.book-menu')

@section('login')
    <p>{{ $login_name }}さん、ログイン中</p>
@endsection

@section('heading', '商品参照')

@section('content')
    <div class="product-content-wrapper clearfix">
        <div class="left">
            <table class="product-content">
                <tr>
                    <td>タイトル</td>
                    <td>
                        <span class="border-bottom">
                          『{{ $product->title }}』
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>価格</td>
                    <td>
                        <span class="border-bottom">
                          {{ $product->price }}円
                        </span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="right">
            <img src="{{ asset($product->image) }}" alt="{{ asset($product->image) }}">
        </div>
    </div>
    <br><br>
    <a class="button black" href="/product/list">古本一覧へ</a>
@endsection
