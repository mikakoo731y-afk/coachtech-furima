@extends('layouts.app')

@section('content')
<div>
    <h2>ご購入手続き</h2>
    <form action="/purchase/{{ $item->id }}" method="POST">
        @csrf
        <div>
            <div>
                <img src="{{ $item->img_url }}" alt="" style="width:100px;">
                <p>{{ $item->name }}</p>
                <p>¥{{ number_format($item->price) }}</p>
            </div>

            <div>
                <h3>支払い方法</h3>
                <select name="payment_method">
                    <option value="">選択してください</option>
                    <option value="konbini">コンビニ払い</option>
                    <option value="card">カード支払い</option>
                </select>
            </div>

            <div>
                <h3>配送先</h3>
                <a href="/purchase/address/{{ $item->id }}">変更する</a>
                <p>〒{{ Auth::user()->profile->postal_code ?? '' }}</p>
                <p>{{ Auth::user()->profile->address ?? '' }}{{ Auth::user()->profile->building ?? '' }}</p>
            </div>
        </div>

        <div>
            <table>
                <tr><th>商品代金</th><td>¥{{ number_format($item->price) }}</td></tr>
                <tr><th>支払い方法</th><td>（選択した方法）</td></tr>
            </table>
            <button type="submit">購入する</button>
        </div>
    </form>
</div>
@endsection
