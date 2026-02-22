@extends('layouts.app')

@section('content')
<div>
    <h2>ログイン</h2>
    <form action="/login" method="POST">
        @csrf
        <div>
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
        </div>
        <div>
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <button type="submit">ログインする</button>
        </div>
    </form>
    <div>
        <a href="/register">会員登録はこちら</a>
    </div>
</div>
@endsection
