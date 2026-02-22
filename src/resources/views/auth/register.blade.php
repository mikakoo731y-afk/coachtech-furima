@extends('layouts.app')

@section('content')
<div>
    <h2>会員登録</h2>

    <!-- Fortifyの登録先パスは /register です -->
    <form action="/register" method="POST">
        @csrf

        <div>
            <label for="name">ユーザー名</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password">
            @error('password')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">確認用パスワード</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <div>
            <button type="submit">登録する</button>
        </div>
    </form>

    <div>
        <a href="/login">ログインはこちら</a>
    </div>
</div>
@endsection
