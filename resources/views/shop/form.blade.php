@extends('layouts.user-login')

@section('heading', '購入手続き')

@section('content')
    <p class="form-title">お客様情報を入力してください</p>
    @if (count($errors) > 0)
        <br><p>入力に問題があります。再入力してください。</p>
    @endif
    <form action="" method="post">
        @csrf
        <table class="customer-form">
            @error('name')
                <tr>
                    <th></th>
                    <td class="error">{{ $message }}</td>
                </tr>
            @enderror
            <tr>
                <td>お名前</td>
                <td>
                    <input type="text" name="name" size="35" value="{{ old('name') }}">
                </td>
            </tr>
            @error('email')
                <tr>
                    <th></th>
                    <td class="error">{{ $message }}</td>
                </tr>
            @enderror
            <tr>
                <td>メールアドレス</td>
                <td>
                    <input type="text" name="email" size="35" value="{{ old('email') }}">
                </td>
            </tr>
            @error('postal')
                <tr>
                    <th></th>
                    <td class="error">{{ $message }}</td>
                </tr>
            @enderror
            <tr>
                <td>郵便番号</td>
                <td>
                    <input type="text" name="postal" size="35" value="{{ old('postal') }}">
                </td>
            </tr>
            @error('address')
                <tr>
                    <th></th>
                    <td class="error">{{ $message }}</td>
                </tr>
            @enderror
            <tr>
                <td>住所</td>
                <td>
                    <input type="text" name="address" size="35" value="{{ old('address') }}">
                </td>
            </tr>
            @error('tel')
                <tr>
                    <th></th>
                    <td class="error">{{ $message }}</td>
                </tr>
            @enderror
            <tr>
                <td>電話番号</td>
                <td>
                    <input type="text" name="tel" size="35" value="{{ old('tel') }}">
                </td>
            </tr>
        </table>
        <div>
            <input class="button black" type="button" onclick="history.back()" value="戻る"> |
            <input class="button black" type="submit" value="確認">
        </div>
    </form>
@endsection
