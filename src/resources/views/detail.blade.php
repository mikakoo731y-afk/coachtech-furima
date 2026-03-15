@extends('layouts.app')

@section('content')
<div class="detail">
    <div class="detail__inner">
        <div class="detail__image">
            <img src="{{ asset('storage/' . $item->img_url) }}" alt="{{ $item->name }}">
        </div>

        {{-- 商品情報 --}}
        <div class="detail__content">
            <div class="detail__header">
                <h2 class="detail__name">{{ $item->name }}</h2>
                <p class="detail__brand">{{ $item->brand_name }}</p>
                <p class="detail__price">¥{{ number_format($item->price) }}<span>（税込）</span></p>

                {{-- アイコンエリア --}}
                <div class="detail__stats">
                    <div class="detail__stat-item">
                        @auth
                            <form action="{{ route('like.store', ['item_id' => $item->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="detail__icon-btn">
                                    <img src="{{ $item->isLikedBy(Auth::user()) ? asset('storage/img/heart-pink.png') : asset('storage/img/heart-default.png') }}" alt="like">
                                </button>
                            </form>
                        @else
                            <img src="{{ asset('storage/img/heart-default.png') }}" alt="like">
                        @endauth
                        <span class="detail__stat-count">{{ $item->likes->count() }}</span>
                    </div>
                    <div class="detail__stat-item">
                        <img src="{{ asset('storage/img/comment.png') }}" alt="comment">
                        <span class="detail__stat-count">{{ $item->comments->count() }}</span>
                    </div>
                </div>
            </div>

            <div class="detail__action">
                <a href="{{ route('purchase.show', ['item_id' => $item->id]) }}" class="detail__btn-purchase">購入手続きへ</a>
            </div>

            <div class="detail__section">
                <h3 class="detail__section-title">商品説明</h3>
                <p class="detail__description">{{ $item->description }}</p>
            </div>

            <div class="detail__section">
                <h3 class="detail__section-title">商品の情報</h3>
                <div class="detail__info-row">
                    <span class="detail__info-label">カテゴリー</span>
                    <div class="detail__categories">
                        @foreach($item->categories as $category)
                            <span class="detail__category-tag">{{ $category->content }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="detail__info-row">
                    <span class="detail__info-label">商品の状態</span>
                    <span class="detail__condition">{{ $item->condition->content }}</span>
                </div>
            </div>

            {{-- コメントセクション --}}
            <div class="detail__section">
                <h3 class="detail__section-title">コメント ({{ $item->comments->count() }})</h3>
                <div class="detail__comment-list">
                    @foreach($item->comments as $comment)
                        <div class="detail__comment-item">
                            <div class="detail__comment-user">
                                @if($comment->user->profile && $comment->user->profile->img_url)
                                    <img src="{{ asset('storage/' . $comment->user->profile->img_url) }}" alt="user">
                                @else
                                    <div class="default-user-icon" style="background: #ccc; width: 40px; height: 40px; border-radius: 50%;"></div>
                                @endif
                                <strong>{{ $comment->user->name }}</strong>
                            </div>
                            <p class="detail__comment-text">{{ $comment->content }}</p>
                        </div>
                    @endforeach
                </div>

                @auth
                    <form action="{{ route('comment.store', ['item_id' => $item->id]) }}" method="POST" class="detail__comment-form">
                        @csrf
                        <label for="comment" class="detail__comment-label">商品へのコメント</label>
                        <textarea name="content" id="comment" class="detail__comment-textarea"></textarea>
                        @error('content')
                            <p class="auth__error">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="detail__btn-comment">コメントを送信する</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
