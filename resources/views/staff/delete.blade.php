@extends('layouts.book-menu')

@section('login')
    <p>{{ $login_name }}さん、ログイン中</p>
@endsection

@section('heading', 'スタッフ削除')

@section('content')
    <form action="" method="post">
        @csrf
        <table>
            <tr>
                <td>スタッフコード</td>
                <td>
                    <span class="border-bottom">
                        {{ $employee->id}}
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
        </table>
        <p>このスタッフを削除してよろしいでしょうか？</p><br>
        <input class="button black" type="button" onclick="history.back()" value="戻る">
          |
        <input class="button black" type="submit" value="削除">
    </form>
@endsection
