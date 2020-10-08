@extends('layouts.book-menu')

@section('login')
    <p>{{ $login_name }}さん、ログイン中</p>
@endsection

@section('heading', 'スタッフ追加')

@section('content')
    <p>{{ $staff_name }}さんを追加しました</p>
    <br>
    <a class="button black" href="/staff/list">
        戻る
    </a>
@endsection
