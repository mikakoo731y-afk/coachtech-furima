@extends('layouts.app')

@section('content')
<div>
    <h2>商品の出品</h2>
    <form action="/sell" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <h3>商品画像</h3>
            <input type="file" name="img_url">
        </div>

        <div>
            <h3>商品の詳細</h3>
            <label>カテゴリー</label>
            <div>
                @foreach($categories as $category)
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"> {{ $category->content }}
                @endforeach
            </div>

            <label>商品の状態</label>
            <select name="condition_id">
                @foreach($conditions as $condition)
                    <option value="{{ $condition->id }}">{{ $condition->content }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <h3>商品名と説明</h3>
            <label>商品名</label>
            <input type="text" name="name">
            <label>ブランド名</label>
            <input type="text" name="brand_name">
            <label>商品の説明</label>
            <textarea name="description"></textarea>
            <label>販売価格</label>
            <input type="number" name="price">
        </div>

        <button type="submit">出品する</button>
    </form>
</div>
@endsection
