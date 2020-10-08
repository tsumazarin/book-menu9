@extends('layouts.book-menu')

@section('login')
    <p>{{ $login_name }}さん、ログイン中</p>
@endsection

@section('heading', '商品修正')

@section('content')
    @if (count($errors) > 0)
        <p>入力に問題があります。再入力してください。</p>
    @endif
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <table class="product-form">
            @error('title')
                <tr>
                    <th></th>
                    <td class="error">{{ $message }}</td>
                </tr>
            @enderror
            <tr>
                <td>タイトルを修正してください</td>
                <td>
                    <input type="text" name="title" size="35" value="{{ $product->title }}">
                </td>
            </tr>
            @error('price')
                <tr>
                    <th></th>
                    <td class="error">{{ $message }}</td>
                </tr>
            @enderror
            <tr>
                <td>価格を再設定してください</td>
                <td>
                    <input id="pro_price" type="text" name="price" size="15" value="{{ $product->price }}">
                    <label for="pro_price">円</label>
                </td>
            </tr>
            @error('image')
                <tr>
                    <th></th>
                    <td class="error">{{ $message }}</td>
                </tr>
            @enderror
            <tr>
                <td>写真</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
        </table>
        <div>
            <input class="button black" type="button" onclick="history.back()" value="戻る"> |
            <input class="button black" type="submit" value="確認">
        </div>
    </form>
@endsection
