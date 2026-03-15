@extends('layouts.app')

@section('content')
<div class="auth">
    <h2 class="auth__title">ログイン</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf
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

        @if ($errors->has('email') && !$errors->has('password'))
        @endif

        <button type="submit" class="auth__btn">ログインする</button>
    </form>

    <div class="auth__footer">
        <a href="{{ route('register') }}" class="auth__link">会員登録はこちら</a>
    </div>
</div>
@endsection
