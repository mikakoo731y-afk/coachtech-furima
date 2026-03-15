@extends('layouts.app')

@section('content')
<div class="address">
    <h2 class="address__title">住所の変更</h2>

    <form action="{{ route('address.update', ['item_id' => $item->id]) }}" method="POST">
        @csrf
        
        <div class="address__group">
            <label for="postal_code" class="address__label">郵便番号</label>
            <input type="text" id="postal_code" name="postal_code" 
                   value="{{ old('postal_code', Auth::user()->profile->postal_code ?? '') }}" class="address__input">
            @error('postal_code')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="address__group">
            <label for="address" class="address__label">住所</label>
            <input type="text" id="address" name="address" 
                   value="{{ old('address', Auth::user()->profile->address ?? '') }}" class="address__input">
            @error('address')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="address__group">
            <label for="building" class="address__label">建物名</label>
            <input type="text" id="building" name="building" 
                   value="{{ old('building', Auth::user()->profile->building ?? '') }}" class="address__input">
            @error('building')
                <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="address__btn">更新する</button>
    </form>
</div>
@endsection
