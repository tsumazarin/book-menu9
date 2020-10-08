@extends('layouts.book-menu')

@section('login')
    <p>{{ $login_name }}さん、ログイン中</p>
@endsection

@section('heading', 'スタッフ参照')

@section('content')
    <table class="staff-form">
        <tr>
            <td>スタッフコード</td>
            <td>
                <span class="border-bottom">
                    {{ $employee->id }}
                </span>
            </td>
        </tr>
        <tr>
            <td>スタッフ名</td>
            <td>
                <span class="border-bottom">
                    {{ $employee->name }}
                </span>
            </td>
        </tr>
        <tr>
            <td>メールアドレス</td>
            <td>
                <span class="border-bottom">
                    {{ $employee->email }}
                </span>
            </td>
        </tr>
        <tr>
            <td>パスワード</td>
            <td>
                <span class="border-bottom">
                    【表示されません】
                </span>
            </td>
        </tr>
    </table>
    <a class="button black" href="/staff/list">スタッフ一覧へ</a>

@endsection
