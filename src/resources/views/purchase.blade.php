@extends('layouts.app')

@section('content')
<div class="purchase">
    <form action="{{ route('purchase.store', ['item_id' => $item->id]) }}" method="POST" class="purchase__form">
        @csrf
        <div class="purchase__main">
            {{-- 商品概要 --}}
            <div class="purchase__item">
                <div class="purchase__item-img">
                    <img src="{{ asset('storage/' . $item->img_url) }}" alt="{{ $item->name }}">
                </div>
                <div class="purchase__item-info">
                    <h2 class="purchase__item-name">{{ $item->name }}</h2>
                    <p class="purchase__item-price">¥{{ number_format($item->price) }}</p>
                </div>
            </div>

            {{-- 支払い方法選択  --}}
            <div class="purchase__section">
                <h3 class="purchase__section-title">支払い方法</h3>
                <div class="purchase__select-wrapper">
                    <select name="payment_method" id="payment_select" class="purchase__select">
                        <option value="" disabled selected>選択してください</option>
                        <option value="konbini">コンビニ払い</option>
                        <option value="card">カード支払い</option>
                    </select>
                </div>
                @error('payment_method')
                    <p class="auth__error">{{ $message }}</p>
                @enderror
            </div>

            {{-- 配送先  --}}
            <div class="purchase__section">
                <div class="purchase__section-header">
                    <h3 class="purchase__section-title">配送先</h3>
                    <a href="{{ route('address.edit', ['item_id' => $item->id]) }}" class="purchase__link">変更する</a>
                </div>
                <div class="purchase__address">
                    <p>〒 {{ $address['postal_code'] }}</p>
                    <p>{{ $address['address'] }}{{ $address['building'] }}</p>
                    <input type="hidden" name="shipping_address" value="〒{{ $address['postal_code'] }} {{ $address['address'] }}{{ $address['building'] }}">
                </div>
            </div>
        </div>

        <aside class="purchase__sidebar">
            <div class="purchase__summary">
                <table class="purchase__table">
                    <tr>
                        <th>商品代金</th>
                        <td>¥{{ number_format($item->price) }}</td>
                    </tr>
                    <tr>
                        <th>支払い方法</th>
                        <td id="payment_display">未選択</td>
                    </tr>
                </table>
            </div>
            <button type="submit" class="purchase__btn">購入する</button>
        </aside>
    </form>
</div>

<script>
    {{-- 支払い方法のリアルタイム反映 (FN023-2) --}}
    document.getElementById('payment_select').addEventListener('change', function() {
        const selectedText = this.options[this.selectedIndex].text;
        document.getElementById('payment_display').textContent = selectedText;
    });
</script>
@endsection
