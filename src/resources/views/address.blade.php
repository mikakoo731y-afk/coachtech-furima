@extends('layouts.app')

@section('content')
<div>
    <h2>住所の変更</h2>
    
    <!-- どの商品に対する配送先変更かを保持するためitem_idをパスに含めます -->
    <form action="/purchase/address/{{ $item->id }}" method="POST">
        @csrf
        
        <div>
            <label for="postal_code">郵便番号</label>
            <!-- 要件：バリデーション（ハイフンあり8文字） -->
            <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', Auth::user()->profile->postal_code ?? '') }}">
            @error('postal_code')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="address">住所</label>
            <input type="text" id="address" name="address" value="{{ old('address', Auth::user()->profile->address ?? '') }}">
            @error('address')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="building">建物名</label>
            <input type="text" id="building" name="building" value="{{ old('building', Auth::user()->profile->building ?? '') }}">
            @error('building')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection
