<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <link rel="icon" href="data:,">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                <a href="{{ route('item.index') }}">
                    <img src="{{ asset('storage/img/logo.png') }}" alt="COACHTECH">
                </a>
            </div>

            @if(!Route::is('login') && !Route::is('register') && !Route::is('verification.notice'))
                {{-- 検索フォーム --}}
                <div class="header__search">
                    <form action="{{ route('item.index') }}" method="GET">
                        @if(request('tab'))
                            <input type="hidden" name="tab" value="{{ request('tab') }}">
                        @endif
                        <input type="text" name="keyword" placeholder="なにをお探しですか？" value="{{ request('keyword') }}" class="header__search-input">
                    </form>
                </div>

                {{-- ナビゲーション --}}
                <nav class="header__nav">
                    <ul class="header__nav-list">
                        @auth
                            <li class="header__nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="header__logout-form">
                                    @csrf
                                    <button type="submit" class="header__nav-link">ログアウト</button>
                                </form>
                            </li>
                            <li class="header__nav-item">
                                <a href="{{ route('mypage.index') }}" class="header__nav-link">マイページ</a>
                            </li>
                        @else
                            <li class="header__nav-item">
                                <a href="{{ route('login') }}" class="header__nav-link">ログイン</a>
                            </li>
                            <li class="header__nav-item">
                                <a href="{{ route('register') }}" class="header__nav-link">会員登録</a>
                            </li>
                        @endauth
                        <li class="header__nav-item">
                            <a href="{{ route('item.create') }}" class="header__nav-btn">出品</a>
                        </li>
                    </ul>
                </nav>
            @endif
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>
</body>
</html>
