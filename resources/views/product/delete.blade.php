@extends('layouts.book-menu')

@section('login')
    <p>{{ $login_name }}さん、ログイン中</p>
@endsection

@section('heading', '商品削除')

@section('content')
<form action="" method="post">
    @csrf
    <div class="product-content-wrapper clearfix">
        <div class="left">
            <table class="product-content">
                <tr>
                    <td>古本コード</td>
                    <td>
                        <span class="border-bottom">
                            {{ $product->id }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>タイトル</td>
                    <td>
                        <span class="border-bottom">
                          『{{ $product->title }}』
                        </span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="right">
            <img src="{{ asset($product->image) }}" alt="{{ asset($product->image) }}">
        </div>
    </div>
    <p>この古本を削除してよろしいでしょうか？</p>
    <br>
    <input class="button black" type="button" onclick="history.back()" value="戻る"> |
    <input class="button black" type="submit" value="削除">
</form>
@endsection
