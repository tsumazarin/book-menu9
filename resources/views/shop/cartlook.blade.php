@extends('layouts.user-login')

@section('heading', 'カート追加')

@section('content')
    @if ($max == 0)
        <div class="clearfix">
          <p>カートに商品が入っていません</p>
          <a class="button black" href="/shop/list">商品一覧へ</a>
        </div>
    @else
        <form action="/shop/cartlook" method="post">
          @csrf
          <table class="black" border="5px solid #fff">
            <tr>
              <td>タイトル</td>
              <td>表紙</td>
              <td>価格</td>
              <td>個数</td>
              <td>小計</td>
              <td>削除</td>
            </tr>
            @for ($i = 0; $i < $max; $i++)
              <tr>
                <td>『{{ $selected_name[$i] }}』</td>
                <td>
                  <img src="{{ asset($selected_image[$i]) }}">
                </td>
                <td>{{ $selected_price[$i] }}円</td>
                <td>
                  <input type="text" name="number{{ $i }}" value="{{ $number[$i] }}" size="5">コ
                </td>
                <td>{{ $selected_price[$i] * $number[$i] }}円</td>
                <td>
                  <input type="checkbox" name="delete{{ $i }}" value="on">
                </td>
              </tr>
            @endfor
          </table>
          <div class="total-and-number">
            <p class="bold">合計：{{ $total }}円</p>
            <p>※　個数は10コ以内でお願いします</p><br>
            <input class="button black" type="submit" value="個数変更">
          </div>
        </form>
        <br>
        <input class="button black" type="button" onclick="history.back()" value="戻る"> |
        <a class="button black" href="/shop/form">ご購入手続きへ進む</a>
        @if (Auth::check() == true)
          |
          <a class="button black" href="/shop/userForm-check">
            会員限定かんたん注文へ進む
          </a>
        @endif
    @endif
@endsection
