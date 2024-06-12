<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                <a href="/">
                    Atte
                </a>
            </div>
            @if(Auth::check())
            <div class="header__button">
                <a href="/">ホーム</a>
                <a href="/attendance">日付一覧</a>
                <a href="/attendance/user_list">ユーザー一覧</a>
                <form class="header__logout" action="/attendance/user" method="get">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth::user()->id }}">
                    <input type="hidden" name="user_name" value="{{ auth::user()->name }}">
                    <button>ユーザー勤怠一覧</button>
                </form>
                <form class="header__logout" action="/logout" method="post">
                    @csrf
                    <button>ログアウト</button>
                </form>
            </div>
            @endif
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer__inner">
            <span>Atte,inc.</span>
        </div>
    </footer>
</body>
</html>