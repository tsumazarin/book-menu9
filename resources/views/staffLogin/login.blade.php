@extends('layouts.book-menu')

@section('heading', 'スタッフログイン')

@section('content')
    <form action="" method="post">
        @csrf
        <dl>
            @error('email')
                <dd class="error">{{ $message }}</dd>
            @enderror
            <dt>メールアドレス</dt>
            <dd>
                <input class="loginInput" type="text" name="email" value="{{ old('email') }}">
            </dd>
            <br>
            @error('pass')
                <dd class="error">{{ $message }}</dd>
            @enderror
            <dt>パスワード</dt>
            <dd>
                <input class="loginInput" type="password" name="pass" value="{{ old('pass') }}">
            </dd>
        </dl>
        <input class="button black" type="submit" value="ログイン">
    </form>
@endsection
