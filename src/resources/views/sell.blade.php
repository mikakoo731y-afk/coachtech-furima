@extends('layouts.app')

@section('content')
<div class="sell">
    <h2 class="sell__title">商品の出品</h2>
    
    <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data" class="sell__form">
        @csrf

        {{-- 商品画像 --}}
        <div class="sell__section">
            <h3 class="sell__section-title">商品画像</h3>
            <div class="sell__image-box">
                <label class="sell__image-label">
                    <input type="file" name="img_url" class="sell__image-input">
                    <span class="sell__image-btn">画像を選択する</span>
                </label>
            </div>
            @error('img_url')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 商品の詳細 --}}
        <div class="sell__section">
            <h3 class="sell__section-title">商品の詳細</h3>
            
            <div class="sell__group">
                <label class="sell__label">カテゴリー</label>
                <div class="sell__category-grid">
                    @foreach($categories as $category)
                        <label class="sell__category-item">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                   {{ is_array(old('categories')) && in_array($category->id, old('categories')) ? 'checked' : '' }}>
                            <span class="sell__category-text">{{ $category->content }}</span>
                        </label>
                    @endforeach
                </div>
                @error('categories')
                    <p class="auth__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="sell__group">
                <label for="condition_id" class="sell__label">商品の状態</label>
                <div class="sell__select-wrapper">
                    <select name="condition_id" id="condition_id" class="sell__select">
                        <option value="" disabled selected>選択してください</option>
                        @foreach($conditions as $condition)
                            <option value="{{ $condition->id }}" {{ old('condition_id') == $condition->id ? 'selected' : '' }}>
                                {{ $condition->content }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('condition_id')
                    <p class="auth__error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- 商品名と説明 --}}
        <div class="sell__section">
            <h3 class="sell__section-title">商品名と説明</h3>
            
            <div class="sell__group">
                <label for="name" class="sell__label">商品名</label>
                <input type="text" name="name" id="name" class="sell__input" value="{{ old('name') }}">
                @error('name')
                    <p class="auth__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="sell__group">
                <label for="brand_name" class="sell__label">ブランド名</label>
                <input type="text" name="brand_name" id="brand_name" class="sell__input" value="{{ old('brand_name') }}">
                @error('brand_name')
                    <p class="auth__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="sell__group">
                <label for="description" class="sell__label">商品の説明</label>
                <textarea name="description" id="description" rows="5" class="sell__textarea">{{ old('description') }}</textarea>
                @error('description')
                    <p class="auth__error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- 販売価格 --}}
        <div class="sell__section">
            <h3 class="sell__section-title">販売価格</h3>
            <div class="sell__group">
                <label for="price" class="sell__label">販売価格</label>
                <div class="sell__price-input">
                    <span class="sell__price-unit">¥</span>
                    <input type="number" name="price" id="price" class="sell__input" value="{{ old('price') }}">
                </div>
                @error('price')
                    <p class="auth__error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit" class="sell__btn">出品する</button>
    </form>
</div>
@endsection
