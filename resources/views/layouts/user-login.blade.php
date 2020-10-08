<!DOCTYPE html>
<html lang="ja">
    <head>
        @include('components.head')
    </head>
    <body>
        <header>
            <h1>古本のアルジ</h1><br>
            <section>　〜品質そこそこ 古本販売サイト〜</section>
                <!-- Authentication Links -->
                @guest
                    <p>ゲストさん、こんにちは</p>
                    <a class="button white" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                    @if (Route::has('register'))
                        <a class="button white" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                    @endif
                @else
                    <p>{{ Auth::user()->name }}さん、ログイン中</p>
                    <a class="button white" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('ログアウト') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            <br>
        </header>
        <main>
            <h2>@yield('heading')</h2>
            <br>
            @yield('content')
        </main>
        <footer>
            @include('components.footer')
            @yield('staff')
        </footer>
    </body>
</html>
