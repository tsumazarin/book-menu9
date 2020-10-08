@extends('layouts.user-login')

@section('heading', 'メニュー')

@section('content')
    <div class="book-lists">
        @foreach ($products as $product)
            <a class="book-list" href="/shop/display?productId={{ $product->id }}">
              <img src="{{ mix($product->image) }}" alt="{{ asset($product->image) }}">
              <br>
              <div class=" black">
                『{{ $product->title }}』　
                {{ $product->price }}円
              </div>
            </a>
            <br>
        @endforeach
      </div>
      <div class="page">
        @if ($page >= 2)
          <a class="page-title" href="/shop/list?page={{ $page - 1 }}">
            {{ $page - 1 }}ページ目へ
          </a>
        @endif
         |
        @if ($page < $max_page)
          <a class="page-title" href="/shop/list?page={{ $page + 1 }}">
            {{ $page + 1 }}ページ目へ
          </a>
        @endif
      </div>
      <br>
      <a class="button black" href="/shop/cartlook">
        カートを見る
      </a>
@endsection

@section('staff')
    <div class="right-side">
        <a class="white-bottom" href="/staff/login">管理者画面へ</a>
    </div>
@endsection
