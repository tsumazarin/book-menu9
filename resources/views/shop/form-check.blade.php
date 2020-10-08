@extends('layouts.user-login')

@section('heading', '購入手続き')

@section('content')
    <form action="" method="post">
        @csrf
        <table class="customer-form-check">
            <tr>
                <td>お名前</td>
                <td>
                    <span class="border-bottom">
                        {{ $customer_name }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>メールアドレス</td>
                <td>
                    <span class="border-bottom">
                        {{ $customer_email }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>郵便番号</td>
                <td>
                    <span class="border-bottom">
                        {{ $customer_postal }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>住所</td>
                <td>
                    <span class="border-bottom">
                        {{ $customer_address }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>電話番号</td>
                <td>
                    <span class="border-bottom">
                        {{ $customer_tel }}
                    </span>
                </td>
            </tr>
        </table>
        <input class="button black" type="button" onclick="history.back()" value="戻る"> |
        <input class="button black" type="submit" name="cash" value="代引き"> |
        <input class="button black" type="submit" name="card" value="カード払い">
    </form>
@endsection
