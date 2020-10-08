@extends('layouts.user-login')

@section('heading', '注文確定')

@section('content')
    <p>
        {{ $customer_name }}様、ご注文ありがとうございました。<br>
        商品は以下の住所に発送させていただきます。<br>
        〒 {{ $customer_postal }}<br>
        住所：{{ $customer_address }}<br>
        電話番号：{{ $customer_tel }}<br>
    </p>
    <br><br><br>
    <a class="button black" href="/shop/list">古本一覧へ</a><br>
    <br><br>
    <hr>
    <h4>メール内容</h4>
    <p>
      {{ $customer_name }}様このたびはご注文ありがとうございました。<br>
      ご注文商品<br>
      ------------
    </p><br>
    @for ($i = 0; $i < $max; $i++)
        <div class="mail-content">
            <p>
                {{ $selected_name[$i] }}<br>
                {{ $selected_price[$i] }}円×{{ $number[$i] }}コ<br>
            </p>
        </div>
        <br>
    @endfor
    <div class="mail-content">
        <p class="mail-content">合計：{{ $total }}円</p><br>
    </div>
    @if ($pay == 'cash')
        <div class="mail-content">
            <p>
                送料は無料です。<br>
                ------------<br>
                <br>
                代金は以下の口座にお振込ください。<br>
                つま銀行 ざりん支店 普通口座 1234567<br>
                入金確認が取れ次第、発送させていただきます。<br>
            </p>
        </div>
        <br>
    @endif
    @if ($pay == 'card')
        <div class="mail-content">
            <p>
                カード支払いが完了しました。<br>
                3日以内にお届けいたします。<br>
            </p>
        </div>
        <br>
    @endif
        <div class="mail-content">
            <p class="mail-content">
                □□□□□□□□□□□□□□□□<br>
                〜品質そこそこ古本のアルジ〜<br>
                <br>
                沖縄県那覇市恩納村123-4<br>
                電話 090-6060-7843<br>
                メール：info@huruhonichiba.co.jp<br>
                □□□□□□□□□□□□□□□□<br>
            </p>
        </div>
        <br>
    <hr>
@endsection
