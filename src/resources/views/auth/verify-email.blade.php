@extends('layouts.app')

@section('content')
<div class="auth">
    <h2 class="auth__title">メール認証が必要です</h2>
    
    <div class="auth__group">
        <p>ご登録いただいたメールアドレスに認証用リンクを送信しました。</p>
        <p>メール内のリンクをクリックして、会員登録を完了させてください。</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="auth__group">
            <p style="color: green; font-weight: bold;">
                新しい認証リンクを送信しました！
            </p>
        </div>
    @endif

    {{-- 認証メール再送機能 --}}
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="auth__btn">認証メールを再送する</button>
    </form>

    <div class="auth__footer">
        <p>※認証が完了している場合は、再度ログインをお試しください。</p>
        <a href="{{ route('login') }}" class="auth__link">ログイン画面へ戻る</a>
    </div>
</div>
@endsection
