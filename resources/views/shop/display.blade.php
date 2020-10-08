@extends('layouts.user-login')

@section('heading', '古本詳細')

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
    <a class="button black" href="/shop/list">古本一覧へ</a> |
    @if ($msg == 'カートに入っています')
        <p>{{ $msg }}</p>
    @else
        <a class="button black" href="/shop/cartin?productId={{ $product->id }}">
            {{ $msg }}
        </a>
    @endif
@endsection
