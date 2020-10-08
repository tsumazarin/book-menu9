@extends('layouts.book-menu')

@section('login')
    <p>{{ $login_name }}さん、ログイン中</p>
@endsection

@section('heading', '商品修正')

@section('content')
    <p>『{{ $product_title }}』を修正しました</p>
    <br>
    <a class="button black" href="/product/list">戻る</a>
@endsection
