@extends('layouts.user-login')

@section('heading', '新規登録')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <table class="login-info">
            <tr>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <td>{{ __('お名前') }}</td>
                <td>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                </td>
            </tr>
            <tr>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <td>{{ __('メールアドレス') }}</td>
                <td>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                </td>
            </tr>
            <tr>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <td>{{ __('パスワード') }}</td>
                <td>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                </td>
            </tr>
            <tr>
                <td>{{ __('確認用パスワード') }}</td>
                <td>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </td>
            </tr>
            <tr>
                @error('postal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <td>{{ __('郵便番号') }}</td>
                <td>
                    <input type="text" class="form-control @error('postal') is-invalid @enderror" name="postal" value="{{ old('postal') }}" required autocomplete="postal" autofocus>
                </td>
            </tr>
            <tr>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <td>{{ __('住所') }}</td>
                <td>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                </td>
            </tr>
            <tr>
                @error('tel')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <td>{{ __('電話番号') }}</td>
                <td>
                    <input type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel" autofocus>
                </td>
            </tr>
        </table>
        <button type="submit" class="button black autologin">
            {{ __('登録') }}
        </button>
        <div class="login-wrapper">
            <a class="forget-pass" href="/shop/list">メニューに戻る</a>
        </div>
    </form>
@endsection
