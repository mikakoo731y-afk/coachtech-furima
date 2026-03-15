@extends('layouts.app')

@section('content')
<div class="index">
    <nav class="index__nav">
        <div class="index__nav-inner">
            <a href="{{ route('item.index', ['keyword' => request('keyword')]) }}" 
               class="index__nav-link {{ !request('tab') ? 'is-active' : '' }}">
                おすすめ
            </a>
            <a href="{{ route('item.index', ['tab' => 'mylist', 'keyword' => request('keyword')]) }}" 
               class="index__nav-link {{ request('tab') === 'mylist' ? 'is-active' : '' }}">
                マイリスト
            </a>
        </div>
    </nav>

    {{-- 商品一覧グリッド --}}
    <div class="index__item-grid">
        @forelse($items as $item)
            <div class="item-card">
                <a href="{{ route('item.show', ['item_id' => $item->id]) }}">
                    <div class="item-card__image-wrapper">
                        {{-- 商品画像 --}}
                        <img src="{{ asset('storage/' . $item->img_url) }}" alt="{{ $item->name }}">
                        {{-- Sold表示 (FN014-3) --}}
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
