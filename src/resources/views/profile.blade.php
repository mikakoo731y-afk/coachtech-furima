@extends('layouts.app')

@section('content')
<div>
    <h2>プロフィール設定</h2>
    <form action="/mypage/profile" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <img src="{{ Auth::user()->profile->img_url ?? '' }}" alt="" style="width:100px;">
            <input type="file" name="img_url">
        </div>

        <div>
            <label>ユーザー名</label>
            <input type="text" name="name" value="{{ old('name', Auth::user()->profile->name ?? Auth::user()->name) }}">
        </div>
        <div>
            <label>郵便番号</label>
            <input type="text" name="postal_code" value="{{ old('postal_code', Auth::user()->profile->postal_code ?? '') }}">
        </div>
        <div>
            <label>住所</label>
            <input type="text" name="address" value="{{ old('address', Auth::user()->profile->address ?? '') }}">
        </div>
        <div>
            <label>建物名</label>
            <input type="text" name="building" value="{{ old('building', Auth::user()->profile->building ?? '') }}">
        </div>

        <button type="submit">更新する</button>
    </form>
</div>
@endsection
