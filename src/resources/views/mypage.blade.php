@extends('layouts.app')

@section('content')
<div>
    <div>
        <img src="{{ Auth::user()->profile->img_url ?? '' }}" alt="プロフ画像" style="width:100px;">
        <h2>{{ Auth::user()->profile->name ?? Auth::user()->name }}</h2>
        <a href="/mypage/profile">プロフィールを編集</a>
    </div>

    <nav>
        <a href="/mypage?page=sell">出品した商品</a>
        <a href="/mypage?page=buy">購入した商品</a>
    </nav>

    <div class="item-grid">
        @foreach($items as $item)
            <div>
                <img src="{{ $item->img_url }}" alt="" style="width:150px;">
                <p>{{ $item->name }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
