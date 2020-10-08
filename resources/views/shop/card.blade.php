@extends('layouts.user-login')

@section('heading', 'クレジット支払い')

@section('content')
    <form action="" method="POST">
        @csrf
        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="{{ env('STRIPE_KEY') }}"
          data-amount="{{ $total }}"
          data-name="この商品の料金は{{ $total }}円です"
          data-locale="auto"
          data-allow-remember-me="false"
          data-label="クレジット決済する"
          data-currency="jpy">
        </script>
    </form>
@endsection
