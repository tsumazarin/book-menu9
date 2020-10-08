@extends('layouts.user-login')

@section('heading', 'ログイン')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        <table class="login-info">
            @csrf
            <tr>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <td>{{ __('メールアドレス') }}</td>
                <td>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </td>
            </tr>
            <br>
            <tr>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <td>{{ __('パスワード') }}</td>
                <td>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                </td>
            </tr>
        </table>
        <div class="autologin">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('自動ログイン') }}
            </label>
        </div>
        <div class="login-wrapper">
            <button type="submit" class="button black">
                {{ __('ログイン') }}
            </button>
        </div>
        <div class="forget-wrapper">
            @if (Route::has('password.request'))
                <a class="forget-pass" href="{{ route('password.request') }}">
                    {{ __('ワスパードを忘れた方') }}
                </a>
            @endif
            　|　
            <a class="forget-pass" href="/shop/list">メニューに戻る</a>
        </div>
    </form>
@endsection
