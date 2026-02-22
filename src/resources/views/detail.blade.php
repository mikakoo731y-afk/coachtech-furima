@extends('layouts.app')

@section('content')
<div>
    <section>
        <div>
            <img src="{{ $item->img_url }}" alt="{{ $item->name }}" style="max-width:400px;">
        </div>
        <div>
            <h2>{{ $item->name }}</h2>
            <p>{{ $item->brand_name }}</p>
            <p>¥{{ number_format($item->price) }}（税込）</p>

            <div>
                <span>いいね数: {{ $item->likes->count() }}</span>
                <span>コメント数: {{ $item->comments->count() }}</span>
            </div>

            <div>
                <a href="/purchase/{{ $item->id }}">購入手続きへ</a>
            </div>

            <div>
                <h3>商品説明</h3>
                <p>{{ $item->description }}</p>
            </div>

            <div>
                <h3>商品の情報</h3>
                <div>
                    <span>カテゴリー:</span>
                    @foreach($item->categories as $category)
                        <span>{{ $category->content }}</span>
                    @endforeach
                </div>
                <div>
                    <span>商品の状態:</span>
                    <span>{{ $item->condition->content }}</span>
                </div>
            </div>

            <div>
                <h3>コメント</h3>
                @foreach($item->comments as $comment)
                    <div>
                        <p>{{ $comment->user->name }}</p>
                        <p>{{ $comment->content }}</p>
                    </div>
                @endforeach

                <form action="/item/comment/{{ $item->id }}" method="POST">
                    @csrf
                    <textarea name="content"></textarea>
                    <button type="submit">コメントを送信する</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
