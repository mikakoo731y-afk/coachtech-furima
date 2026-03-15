@extends('layouts.app')

@section('content')
<div class="auth">
    <h2 class="auth__title">会員登録</h2>

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="auth__group">
            <label for="name" class="auth__label">ユーザー名</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="auth__input">
            @error('name')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth__group">
            <label for="email" class="auth__label">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="auth__input">
            @error('email')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth__group">
            <label for="password" class="auth__label">パスワード</label>
            <input type="password" id="password" name="password" class="auth__input">
            @error('password')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth__group">
            <label for="password_confirmation" class="auth__label">確認用パスワード</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="auth__input">
        </div>

        <button type="submit" class="auth__btn">登録する</button>
    </form>

    <div class="auth__footer">
        <a href="{{ route('login') }}" class="auth__link">ログインはこちら</a>
    </div>
</div>
@endsection
