@extends('layouts.app')

@section('content')
<div>
    <!-- 要件：タブ切り替え（おすすめ/マイリスト） -->
    <nav>
        <div>
            <a href="/">おすすめ</a>
            <a href="/?tab=mylist">マイリスト</a>
        </div>
    </nav>

    <section>
        <h2>商品一覧</h2>
        <div class="item-grid">
            @foreach($items as $item)
                <div class="item-card">
                    <a href="/item/{{ $item->id }}">
                        <!-- 商品画像（Storageまたは外部URL） -->
                        <div>
                            <img src="{{ $item->img_url }}" alt="{{ $item->name }}" style="width: 100%; max-width: 200px;">
                        </div>
                        <div>
                            <p>{{ $item->name }}</p>
                            <!-- 価格（カンマ区切り） -->
                            <p>¥{{ number_format($item->price) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
