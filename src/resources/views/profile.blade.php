@extends('layouts.app')

@section('content')
<div class="profile">
    <h2 class="profile__title">プロフィール設定</h2>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile__form">
        @csrf

        {{-- プロフィール画像選択  --}}
        <div class="profile__image-section">
            <div class="profile__image-box">
                <img src="{{ Auth::user()->profile && Auth::user()->profile->img_url ? asset('storage/' . Auth::user()->profile->img_url) : asset('img/default-user.png') }}" 
                     alt="ユーザー画像" class="profile__image-preview">
            </div>
            <label class="profile__image-label">
                <input type="file" name="img_url" class="profile__image-input">
                <span class="profile__image-btn">画像を選択する</span>
            </label>
            @error('img_url')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        {{-- ユーザー名  --}}
        <div class="profile__group">
            <label for="name" class="profile__label">ユーザー名</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="profile__input">
            @error('name')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 郵便番号  --}}
        <div class="profile__group">
            <label for="postal_code" class="profile__label">郵便番号</label>
            <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $profile->postal_code) }}" class="profile__input">
            @error('postal_code')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 住所  --}}
        <div class="profile__group">
            <label for="address" class="profile__label">住所</label>
            <input type="text" id="address" name="address" value="{{ old('address', $profile->address) }}" class="profile__input">
            @error('address')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 建物名  --}}
        <div class="profile__group">
            <label for="building" class="profile__label">建物名</label>
            <input type="text" id="building" name="building" value="{{ old('building', $profile->building) }}" class="profile__input">
            @error('building')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="profile__btn">更新する</button>
    </form>
</div>
@endsection
