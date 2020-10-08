@extends('layouts.book-menu')

@section('login')
    <p>{{ $login_name }}さん、ログイン中</p>
@endsection

@section('heading', 'スタッフ修正')

@section('content')
    <form action="" method="post">
        @csrf
        @if (count($errors) > 0)
            <p>入力に問題があります。再入力してください。</p>
        @endif
        <table class="staff-form">
            <tr>
                <td>スタッフコード</td>
                <td>
                    <span class="bold">
                        {{ $employee->id }}
                    </span>
                </td>
            </tr>
            @error('name')
                <tr>
                    <th></th>
                    <td class="error">{{ $message }}</td>
                </tr>
            @enderror
            <tr>
                <td>スタッフ名</td>
                <td>
                    <input type="text" name="name" size="30" value="{{ $employee->name }}">
                </td>
            </tr>
            @error('email')
                <tr>
                    <th></th>
                    <td class="error">{{ $message }}</td>
                </tr>
            @enderror
            <tr>
                <td>メールアドレスを入力してください</td>
                <td>
                    <input type="text" name="email" size="30" value="{{ $employee->email }}">
                </td>
            </tr>
            @error('pass')
                <tr>
                    <th></th>
                    <td class="error">{{ $message }}</td>
                </tr>
            @enderror
            <tr>
                <td>パスワードを再設定してください</td>
                <td>
                    <input type="password" name="pass" size="30" value="{{ $employee->password }}">
                </td>
            </tr>
            @error('pass2')
                <tr>
                    <th></th>
                    <td class="error">{{ $message }}</td>
                </tr>
            @enderror
            <tr>
                <td>パスワードをもう１度入力してください</td>
                <td>
                    <input type="password" name="pass2" size="30" value="">
                </td>
            </tr>
        </table>
        <input class="button black" type="button" onclick="history.back()" value="戻る"> |
        <input class="button black" type="submit" value="確認">
    </form>
@endsection
