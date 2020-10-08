<!DOCTYPE html>
<html lang="ja">
    <head>
        @include('components.head')
    </head>
    <body>
        <header>
            <h1>古本のアルジ</h1><br>
            <section>　〜品質そこそこ 古本販売サイト〜</section><br>
            @yield('login')
        </header>
        <main>
            <h2>@yield('heading')</h2>
            <br>
            @yield('content')
        </main>
        @include('components.footer')
    </body>
</html>
