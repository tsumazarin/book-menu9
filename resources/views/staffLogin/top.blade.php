@extends('layouts.book-menu')

@section('login')
    <p>{{ $login_name }}さん、ログイン中</p>
    <a class="button white" href="/staff/logout">ログアウト</a>
@endsection

@section('heading', '管理者ページ')

@section('content')
    <a class="button black" href="/staff/list">
      スタッフ管理
    </a>
    <dd></dd>
    <br><br>
    <a class="button black" href="/product/list">
      古本管理
    </a><br>
    <dd></dd>
    <br><br>
    <a class="button black" href="/order/download">
      注文ダウンロード
    </a>
    <dd></dd>
@endsection
