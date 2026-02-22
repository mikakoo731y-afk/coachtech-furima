<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
</head>
<body>
    <header>
        <div>
            <h1><a href="/">coachtechフリマ</a></h1>
        </div>
        <div>
            <form action="/" method="GET">
                <input type="text" name="keyword" placeholder="なにをお探しですか？">
            </form>
        </div>
        <nav>
            <div>
                @if(Auth::check())
                    <form action="/logout" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                    <a href="/mypage">マイページ</a>
                @else
                    <a href="/login">ログイン</a>
                    <a href="/register">会員登録</a>
                @endif
                <a href="/sell">出品</a>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
