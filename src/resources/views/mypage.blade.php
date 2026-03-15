@extends('layouts.app')

@section('content')
<div class="mypage">
    {{-- ユーザー情報エリア  --}}
    <div class="mypage__profile">
        <div class="mypage__profile-inner">
            <div class="mypage__image">
                <img src="{{ Auth::user()->profile && Auth::user()->profile->img_url ? asset('storage/' . Auth::user()->profile->img_url) : asset('img/default-user.png') }}" alt="ユーザー画像">
            </div>
            <h2 class="mypage__name">{{ Auth::user()->profile->name ?? Auth::user()->name }}</h2>
            <a href="{{ route('profile.edit') }}" class="mypage__edit-btn">プロフィールを編集</a>
        </div>
    </div>

    <nav class="index__nav">
        <div class="index__nav-inner">
            <a href="{{ route('mypage.index', ['page' => 'sell']) }}" 
               class="index__nav-link {{ request('page') !== 'buy' ? 'is-active' : '' }}">
                出品した商品
            </a>
            <a href="{{ route('mypage.index', ['page' => 'buy']) }}" 
               class="index__nav-link {{ request('page') === 'buy' ? 'is-active' : '' }}">
                購入した商品
            </a>
        </div>
    </nav>

    {{-- 商品一覧グリッド --}}
    <div class="index__item-grid">
        @forelse($items as $item)
            <div class="item-card">
                <a href="{{ route('item.show', ['item_id' => $item->id]) }}">
                    <div class="item-card__image-wrapper">
                        <img src="{{ asset('storage/' . $item->img_url) }}" alt="{{ $item->name }}">
                        @if($item->purchases->isNotEmpty())
                            <div class="item-card__sold">
                                <span>Sold</span>
                            </div>
                        @endif
                    </div>
                    <div class="item-card__content">
                        <p class="item-card__name">{{ $item->name }}</p>
                    </div>
                </a>
            </div>
        @empty
            <div class="index__empty">
                <p>表示する商品がありません。</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
