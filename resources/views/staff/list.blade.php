@extends('layouts.book-menu')

@section('login')
    <p>{{ $login_name }}さん、ログイン中</p>
    <a class="button white" href="/staff/logout">ログアウト</a>
@endsection

@section('heading', 'スタッフ一覧')

@section('content')
    <form action="" method="post">
        @csrf
        @foreach ($employees as $employee)
            <input type="radio" name="staff_id" value="{{ $employee->id }}">
            {{ $employee->name }}
            <br>
        @endforeach
        <br><br>
        <input class="button black" type="submit" name="display" value="参照"> |
        <input class="button black" type="submit" name="add" value="追加"> |
        <input class="button black" type="submit" name="edit" value="修正"> |
        <input class="button black" type="submit" name="delete" value="削除">
    </form>
    <br><br>
    <a class="button black" href="/staff/top">トップメニューへ</a>
@endsection
