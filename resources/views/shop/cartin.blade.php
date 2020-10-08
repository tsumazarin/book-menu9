@extends('layouts.user-login')

@section('heading', 'カート追加')

@section('content')
    <p>『{{ $product->title }}』をカートに追加しました</p>
    <br><br>
    <a class="button black" href="/shop/list">古本一覧に戻る</a>
@endsection
